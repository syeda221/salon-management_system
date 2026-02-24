<?php

class SalonBookingSystem {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    /* =====================================================
       1. CREATE CLIENT IF NOT EXISTS
    ===================================================== */
    public function getOrCreateClient($name,$email,$phone){

        $stmt = $this->conn->prepare(
            "SELECT id FROM clients WHERE email=?"
        );
        $stmt->execute([$email]);
        $client = $stmt->fetch();

        if($client){
            return $client['id'];
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO clients(name,email,phone) VALUES(?,?,?)"
        );
        $stmt->execute([$name,$email,$phone]);

        return $this->conn->lastInsertId();
    }


    /* =====================================================
       2. CHECK STAFF SLOT AVAILABILITY
    ===================================================== */
    public function isSlotAvailable($staff_id,$date,$slot_id){

        $stmt = $this->conn->prepare("
        SELECT id FROM appointments
        WHERE staff_id=?
        AND appointment_date=?
        AND slot_id=?
        AND status='confirmed'
        ");

        $stmt->execute([$staff_id,$date,$slot_id]);

        return $stmt->rowCount()==0;
    }


    /* =====================================================
       3. CREATE BOOKING REQUEST (PENDING)
    ===================================================== */
    public function createAppointment(
        $client_name,
        $client_email,
        $client_phone,
        $staff_id,
        $date,
        $slot_id,
        $services_array
    ){

        if(!$this->isSlotAvailable($staff_id,$date,$slot_id)){
            return "Slot already booked";
        }

        $client_id = $this->getOrCreateClient(
            $client_name,
            $client_email,
            $client_phone
        );

        /* insert appointment */
        $stmt = $this->conn->prepare("
        INSERT INTO appointments
        (client_id,staff_id,appointment_date,slot_id,status)
        VALUES(?,?,?,?, 'pending')
        ");

        $stmt->execute([
            $client_id,
            $staff_id,
            $date,
            $slot_id
        ]);

        $appointment_id = $this->conn->lastInsertId();

        /* insert multiple services */
        foreach($services_array as $service){
            $stmt = $this->conn->prepare("
            INSERT INTO appointment_services
            (appointment_id,service_id)
            VALUES(?,?)
            ");
            $stmt->execute([$appointment_id,$service]);
        }

        return $appointment_id;
    }


    /* =====================================================
       4. ADMIN CONFIRM APPOINTMENT
    ===================================================== */
    public function confirmAppointment($appointment_id){

        $data = $this->getAppointment($appointment_id);

        if(!$this->isSlotAvailable(
            $data['staff_id'],
            $data['appointment_date'],
            $data['slot_id']
        )){
            return "Time not available";
        }

        $stmt = $this->conn->prepare("
        UPDATE appointments
        SET status='confirmed'
        WHERE id=?
        ");
        $stmt->execute([$appointment_id]);

        $this->sendEmail(
            $data['email'],
            "Appointment Confirmed",
            "Your appointment has been confirmed"
        );

        return true;
    }


    /* =====================================================
       5. ADMIN REJECT APPOINTMENT
    ===================================================== */
    public function rejectAppointment($appointment_id){

        $stmt = $this->conn->prepare("
        UPDATE appointments
        SET status='rejected'
        WHERE id=?
        ");
        $stmt->execute([$appointment_id]);

        $data = $this->getAppointment($appointment_id);

        $this->sendEmail(
            $data['email'],
            "Appointment Rejected",
            "Your requested time is not available"
        );

        return true;
    }


    /* =====================================================
       6. UPDATE APPOINTMENT
    ===================================================== */
    public function updateAppointment(
        $appointment_id,
        $staff_id,
        $date,
        $slot_id
    ){

        $stmt = $this->conn->prepare("
        UPDATE appointments
        SET staff_id=?,
            appointment_date=?,
            slot_id=?
        WHERE id=?
        ");

        return $stmt->execute([
            $staff_id,
            $date,
            $slot_id,
            $appointment_id
        ]);
    }


    /* =====================================================
       7. DELETE APPOINTMENT
    ===================================================== */
    public function deleteAppointment($id){
        $stmt = $this->conn->prepare(
            "DELETE FROM appointments WHERE id=?"
        );
        return $stmt->execute([$id]);
    }


    /* =====================================================
       8. GET SINGLE APPOINTMENT WITH CLIENT
    ===================================================== */
    public function getAppointment($id){

        $stmt = $this->conn->prepare("
        SELECT a.*, c.name, c.email
        FROM appointments a
        JOIN clients c ON a.client_id=c.id
        WHERE a.id=?
        ");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }


    /* =====================================================
       9. GET ALL PENDING APPOINTMENTS (ADMIN PANEL)
    ===================================================== */
    public function getPendingAppointments(){

        $stmt = $this->conn->query("
        SELECT a.*, c.name, c.email
        FROM appointments a
        JOIN clients c ON a.client_id=c.id
        WHERE status='pending'
        ORDER BY created_at DESC
        ");

        return $stmt->fetchAll();
    }


    /* =====================================================
       10. EMAIL FUNCTION (simple PHP mail)
    ===================================================== */
    private function sendEmail($to,$subject,$message){

        $headers = "From: salon@gmail.com";
        mail($to,$subject,$message,$headers);
    }

}