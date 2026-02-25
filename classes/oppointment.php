<?php

class SalonBookingSystem {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    /* ======================================
       CREATE CLIENT IF NOT EXISTS
    ====================================== */
    public function getOrCreateClient($name,$email,$phone){

        $stmt=$this->conn->prepare("SELECT id FROM clients WHERE email=?");
        $stmt->execute([$email]);
        $c=$stmt->fetch();

        if($c) return $c['id'];

        $stmt=$this->conn->prepare(
        "INSERT INTO clients(name,email,phone) VALUES(?,?,?)");
        $stmt->execute([$name,$email,$phone]);

        return $this->conn->lastInsertId();
    }


    /* ======================================
       CHECK STAFF AVAILABILITY
    ====================================== */
    public function isStaffAvailable($staff,$date,$slot){

        $stmt=$this->conn->prepare("
        SELECT id FROM appointments
        WHERE staff_id=?
        AND appointment_date=?
        AND slot_id=?
        AND status='confirmed'
        ");

        $stmt->execute([$staff,$date,$slot]);

        return $stmt->rowCount()==0;
    }


    /* ======================================
       CREATE BOOKING REQUEST (NO STAFF)
    ====================================== */
    public function createAppointment(
        $name,$email,$phone,$date,$slot,$services
    ){

        $client=$this->getOrCreateClient($name,$email,$phone);

        $stmt=$this->conn->prepare("
        INSERT INTO appointments
        (client_id,appointment_date,slot_id,status)
        VALUES(?,?,?, 'pending')
        ");

        $stmt->execute([$client,$date,$slot]);

        $appointment=$this->conn->lastInsertId();

        foreach($services as $s){
            $stmt=$this->conn->prepare("
            INSERT INTO appointment_services
            (appointment_id,service_id)
            VALUES(?,?)
            ");
            $stmt->execute([$appointment,$s]);
        }

        return $appointment;
    }


    /* ======================================
       ADMIN ASSIGN + CONFIRM
    ====================================== */
public function assignAndConfirm($appointment_id, $staff_id){

    $data = $this->getAppointment($appointment_id);

    if(!$data){
        return "Appointment not found";
    }

    // ❌ stylist not available → reject + apology email
    if(!$this->isStaffAvailable(
        $staff_id,
        $data['appointment_date'],
        $data['slot_id']
    )){
        $this->rejectWithApology(
            $appointment_id,
            $data['email'],
            $data['name']
        );

        return "Stylist not available — apology email sent";
    }

    // ✅ stylist available → confirm
    $stmt = $this->conn->prepare("
        UPDATE appointments
        SET staff_id = ?, status = 'confirmed'
        WHERE id = ?
    ");
    $stmt->execute([$staff_id, $appointment_id]);

    // confirmation email
    $message = "
        <h2>Appointment Confirmed</h2>
        <p>Hello ".$data['name']."</p>
        <p>Your appointment has been confirmed.</p>
        <p><b>Date:</b> ".$data['appointment_date']."</p>
        <p>We look forward to seeing you 💇‍♀️</p>
    ";

    $this->sendEmail(
        $data['email'],
        "Appointment Confirmed",
        $message
    );

    return true;
}

private function rejectWithApology($id,$email,$name){

    $stmt=$this->conn->prepare("
        UPDATE appointments SET status='rejected'
        WHERE id=?
    ");
    $stmt->execute([$id]);

    $message = "
        <h2>Appointment Update</h2>
        <p>Hello $name</p>
        <p>We are sorry 😔</p>
        <p>Your requested time is not available.</p>
        <p>Please choose another time.</p>
    ";

    $this->sendEmail($email,"Appointment Not Available",$message);
}
    /* ======================================
       REJECT
    ====================================== */
    public function rejectAppointment($id){

        $stmt=$this->conn->prepare("
        UPDATE appointments SET status='rejected'
        WHERE id=?
        ");
        $stmt->execute([$id]);

        $data=$this->getAppointment($id);

        $this->sendEmail(
            $data['email'],
            "Appointment Rejected",
            "Please select another time"
        );
    }

public function getConfirmedAppointments(){

    $stmt = $this->conn->query("
        SELECT 
            a.*,
            c.name AS client_name,
            c.email,
            s.name AS staff_name,
            sv.service_name,
            ts.slot_time
        FROM appointments a
        JOIN clients c      ON a.client_id = c.id
        JOIN staff s        ON a.staff_id = s.id
        JOIN services sv    ON a.service_id = sv.id
        JOIN time_slots ts  ON a.slot_id = ts.id
        WHERE a.status = 'confirmed'
        ORDER BY a.appointment_date DESC
    ");

    return $stmt->fetchAll();
}

    /* ======================================
       GET PENDING
    ====================================== */
    public function getPendingAppointments(){

        $stmt=$this->conn->query("
        SELECT a.*, c.name,c.email
        FROM appointments a
        JOIN clients c ON a.client_id=c.id
        WHERE status='pending'
        ORDER BY created_at DESC
        ");

        return $stmt->fetchAll();
    }


    /* ======================================
       EMAIL
    ====================================== */
 private function sendEmail($to,$subject,$message){

    require '../vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'qunootzehra21@gmail.com';
        $mail->Password   = 'xxsjkceslyolevok';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('qunootzehra@gmail.com','Salon Booking');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();

    }catch(Exception $e){
        echo "Email error: ".$mail->ErrorInfo;
    }
}
}