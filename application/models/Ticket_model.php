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
    public function saverecords($numSeats, $seats, $user_id)
    {
        $this->db->query("INSERT INTO tickets (ticket_id, user_id, quantity, position, active, buytime) VALUES (DEFAULT, $user_id, $numSeats, $seats, 1, CURRENT_TIMESTAMP) ");
        return true;
    }
    public function show($user_id)
    {
        $query=$this->db->query("SELECT ticket_id, user_id, connection_id, quantity, position, compartment, active, buytime FROM tickets WHERE active=1 AND user_id=$user_id");
        return $query->result();
    }
    public function cancelTicket($idTicket)
    {
        $query=$this->db->query("UPDATE tickets SET active = 0 WHERE ticket_id = $idTicket");
    }
}


