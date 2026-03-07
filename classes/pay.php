<?php

class Payment {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    // get total price of appointment services
    public function getTotalAmount($appointment_id){

        $q = $this->db->prepare("
            SELECT SUM(s.price) as total
            FROM appointment_services aps
            JOIN services s ON s.id = aps.service_id
            WHERE aps.appointment_id = ?
        ");

        $q->execute([$appointment_id]);
        return $q->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // make payment
    public function makePayment($appointment_id, $method){

        $amount = $this->getTotalAmount($appointment_id);

        // insert payment record
        $q = $this->db->prepare("
            INSERT INTO payments (appointment_id, amount, payment_method)
            VALUES (?,?,?)
        ");
        $q->execute([$appointment_id, $amount, $method]);

        // update appointment
        $update = $this->db->prepare("
            UPDATE appointments
            SET payment_status='paid',
                status = 'completed',
                paid_amount=?,
                payment_method=?,
                paid_at=NOW()
            WHERE id=?
        ");

        $update->execute([$amount,$method,$appointment_id]);

        return $amount;
    }
}