<?php

class Ticket_model extends CI_Model {
    public $count;
    public $price;
    public $ticket_id;
    public $train_id;
    public $arrival_date;
    public $departure_date;
    //??? public skąd/dokąd
    //public $user_id;
    public function saverecords($numSeats, $user_id, $id_connection, $payment, $from, $where)
    {

        // $start=$this->db->query("SELECT stops_id FROM connections_stops WHERE town = '.$from.'");
        // $end=$this->db->query("SELECT stops_id FROM connections_stops WHERE town = '.$where.'");
        // $this->db->query("INSERT INTO tickets (ticket_id, user_id, train_id, position, active, buytime, start, end) VALUES (DEFAULT, $user_id, 1, $seats, 1, CURRENT_TIMESTAMP, 1, 1) ");
        $this->db->query("INSERT INTO tickets VALUES (DEFAULT, $user_id, $id_connection, 1, $numSeats, 1, 1, CURRENT_TIMESTAMP, 1, 1, $payment) ");
        return true;
    }
    public function show($user_id)
    {
        // $query=$this->db->query("SELECT `ticket_id`, `user_id`, `connection_id`, `train_id`, `position`, `compartment`, `active`, `buytime`, `start`, `end`, `payment` FROM `tickets` WHERE `active`=1 AND `user_id`=$user_id");
        $query=$this->db->query("SELECT `ticket_id`, `user_id`, `connection_id`, `position`, `active`, `buytime`, `start`, `end`, `payment` FROM `tickets` WHERE `active`=1 AND `user_id`=$user_id");
        return $query->result();
    }
    public function cancelTicket($idTicket)
    {
        $query=$this->db->query("UPDATE tickets SET active = 0 WHERE ticket_id = $idTicket");
    }
    public function payTicket($idTicket)
    {
        $query=$this->db->query("UPDATE tickets SET payment = 1 WHERE ticket_id = $idTicket");
    }
}


