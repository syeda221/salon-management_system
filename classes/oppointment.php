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
    public function assignAndConfirm($appointment,$staff){

        $data=$this->getAppointment($appointment);

        if(!$this->isStaffAvailable(
            $staff,
            $data['appointment_date'],
            $data['slot_id']
        )){
            return "Stylist not available";
        }

        $stmt=$this->conn->prepare("
        UPDATE appointments
        SET staff_id=?, status='confirmed'
        WHERE id=?
        ");
        $stmt->execute([$staff,$appointment]);

        $this->sendEmail(
            $data['email'],
            "Appointment Confirmed",
            "Your appointment has been confirmed"
        );

        return true;
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


    /* ======================================
       GET SINGLE
    ====================================== */
    public function getAppointment($id){

        $stmt=$this->conn->prepare("
        SELECT a.*, c.name, c.email
        FROM appointments a
        JOIN clients c ON a.client_id=c.id
        WHERE a.id=?
        ");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }


    /* ======================================
       GET PENDING
    ====================================== */
    public function getPendingAppointments(){

        $stmt=$this->conn->query("
        SELECT a.*, c.name
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
        mail($to,$subject,$message,"From: salon@gmail.com");
    }
}