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
    public function saverecords($numSeats, $user_id, $id_connection, $payment, $id_start, $id_end)
    {

        // $start=$this->db->query("SELECT stops_id FROM connections_stops WHERE town = '.$from.'");
        // $end=$this->db->query("SELECT stops_id FROM connections_stops WHERE town = '.$where.'");
        // $this->db->query("INSERT INTO tickets (ticket_id, user_id, train_id, position, active, buytime, start, end) VALUES (DEFAULT, $user_id, 1, $seats, 1, CURRENT_TIMESTAMP, 1, 1) ");

        for($i=0;$i<$numSeats;$i++)
        {
            $this->db->query("INSERT INTO tickets VALUES (DEFAULT, $user_id, $id_connection, 1, 0, 1, 1, CURRENT_TIMESTAMP, $id_start, $id_end, $payment) ");
        }
        return true;
    }
    public function show($user_id)
    {
        // $query=$this->db->query("SELECT `ticket_id`, `user_id`, `connection_id`, `train_id`, `position`, `compartment`, `active`, `buytime`, `start`, `end`, `payment` FROM `tickets` WHERE `active`=1 AND `user_id`=$user_id");
        $query=$this->db->query("SELECT COUNT(*) AS ilosc, `ticket_id`, `user_id`, `connection_id`, `position`, `active`, `buytime`, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = end) AS end, (SELECT connections_stops.date FROM connections_stops WHERE stops_id = start) AS date, `payment` FROM `tickets` WHERE `active`=1 AND `user_id`=$user_id GROUP BY buytime" );
        return $query->result();
    }
    public function cancelTicket($idTicket)
    {
        $query=$this->db->query("UPDATE tickets SET active = 0 WHERE ticket_id = $idTicket");
    }
    public function cancelAllTicket($idTicket)
    {
        $query=$this->db->query("UPDATE tickets SET active = 0 WHERE buytime = (SELECT buytime FROM tickets WHERE ticket_id = $idTicket)");
    }
    public function payTicket($idTicket)
    {
        //$query=$this->db->query("UPDATE tickets SET payment = 1 WHERE ticket_id = $idTicket");
        $query=$this->db->query("UPDATE tickets SET payment = 1 WHERE `buytime` = (SELECT buytime FROM tickets WHERE ticket_id = $idTicket)");
        //WHERE `buytime` = (SELECT buytime FROM tickets WHERE ticket_id = $ticket_id)
    }
    public function showAll()
    {
        $query=$this->db->query("SELECT t.ticket_id, user.user_name, t.connection_id, t.position, t.active, t.buytime, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.end) AS end, t.payment FROM tickets t INNER JOIN user ON t.user_id=user.user_id INNER JOIN user_type ON user.user_type_id = user_type.user_type_id WHERE user_type.name = 'head_admin' AND active=1; ");
        return $query->result();
    }
    public function ticketsDetails($user_id, $ticket_id)
    {
        $query=$this->db->query("SELECT `ticket_id`, `user_id`, `connection_id`, `position`, `active`, `buytime`, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = end) AS end, (SELECT connections_stops.date FROM connections_stops WHERE stops_id = start) AS dateFrom, (SELECT connections_stops.date FROM connections_stops WHERE stops_id = end) AS dateTo, `payment` FROM `tickets` WHERE `buytime` = (SELECT buytime FROM tickets WHERE ticket_id = $ticket_id) and `active`= 1 AND `user_id`=$user_id "); //
        //$query=$this->db->query("SELECT t.ticket_id, t.user_id, t.connection_id, t.position, t.active, t.buytime, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.end) AS end FROM tickets t INNER JOIN connections_stops cs ON t.connection_id = cs.connection_id WHERE `buytime` = (SELECT buytime FROM tickets WHERE ticket_id = $ticket_id) and `active`= 1 AND `user_id`=$user_id ;");
        return $query->result();
    }
    public function quantity($numSeats, $id_connection, $id_start, $id_end)
    {
        //$query=$this->db->query("SELECT train.train_id, (SUM(compartment.quantity_seats) - (SELECT COUNT(ticket_id) FROM tickets WHERE active = 1 AND connection_id = $id_connection )) AS wolne FROM train INNER JOIN train_carriage ON train.train_id=train_carriage.train_id INNER JOIN carriage ON train_carriage.carriage_id = carriage.carriage_id INNER JOIN carriage_compartment ON carriage.carriage_id = carriage_compartment.carriage_id INNER JOIN compartment ON compartment.compartment_id = carriage_compartment.compartment_id WHERE train.train_id = 1 GROUP BY train.train_id;");
        $query=$this->db->query("SELECT train.train_id, (SUM(compartment.quantity_seats) 
        - (SELECT COUNT(*) FROM (SELECT t.ticket_id, t.start, t.end, (SELECT date FROM connections_stops WHERE stops_id = t.start) AS date_start, (SELECT date FROM connections_stops WHERE stops_id = t.end) AS date_END FROM tickets t INNER JOIN connections_stops cs ON t.connection_id = cs.connection_id WHERE t.active=1 AND t.connection_id = $id_connection AND ((SELECT date FROM connections_stops WHERE stops_id = t.start AND connection_id = $id_connection) > (SELECT date FROM connections_stops WHERE stops_id = $id_start AND connection_id = $id_connection) AND (SELECT date FROM connections_stops WHERE stops_id = t.end AND connection_id = $id_connection) > (SELECT date FROM connections_stops WHERE stops_id = $id_end AND connection_id = $id_connection)) GROUP BY t.ticket_id) i ) 
        - (SELECT COUNT(*) FROM (SELECT t.ticket_id, t.start, t.end, (SELECT date FROM connections_stops WHERE stops_id = t.start) AS date_start, (SELECT date FROM connections_stops WHERE stops_id = t.end) AS date_END FROM tickets t INNER JOIN connections_stops cs ON t.connection_id = cs.connection_id WHERE t.active=1 AND t.connection_id = $id_connection AND ((SELECT date FROM connections_stops WHERE stops_id = t.start AND connection_id = $id_connection) = (SELECT date FROM connections_stops WHERE stops_id = $id_start AND connection_id = $id_connection) AND (SELECT date FROM connections_stops WHERE stops_id = t.end AND connection_id = $id_connection) = (SELECT date FROM connections_stops WHERE stops_id = $id_end AND connection_id = $id_connection)) GROUP BY t.ticket_id) i) 
        + (SELECT COUNT(*) FROM (SELECT t.ticket_id, t.start, t.end, (SELECT date FROM connections_stops WHERE stops_id = t.start) AS date_start, (SELECT date FROM connections_stops WHERE stops_id = t.end) AS date_END FROM tickets t INNER JOIN connections_stops cs ON t.connection_id = cs.connection_id WHERE t.active=1 AND t.connection_id = $id_connection AND ((SELECT date FROM connections_stops WHERE stops_id = $id_start AND connection_id = $id_connection) < (SELECT date FROM connections_stops WHERE stops_id = t.start AND connection_id = $id_connection) AND (SELECT date FROM connections_stops WHERE stops_id = $id_end AND connection_id = $id_connection) < (SELECT date FROM connections_stops WHERE stops_id = t.end AND connection_id = $id_connection)) GROUP BY t.ticket_id) i) ) AS wolne FROM train INNER JOIN train_carriage ON train.train_id=train_carriage.train_id INNER JOIN carriage ON train_carriage.carriage_id = carriage.carriage_id INNER JOIN carriage_compartment ON carriage.carriage_id = carriage_compartment.carriage_id INNER JOIN compartment ON compartment.compartment_id = carriage_compartment.compartment_id WHERE train.train_id = 1 GROUP BY train.train_id;");
        return $query->row(); 
    }
    public function cost($id_connection, $id_start, $id_end)
    {
        $query=$this->db->query("SELECT COUNT(*) as stops FROM connections_stops WHERE date >= (SELECT date FROM connections_stops WHERE stops_id = $id_start) AND date <= (SELECT date FROM connections_stops WHERE stops_id = $id_end) AND connection_id = $id_connection ORDER BY date; ");
        return $query->row();
    }
    public function get_count() {
        //return $this->db->count_all($this->tickets);
        return $query=$this->db->query("SELECT COUNT(*) FROM tickets WHERE active = 1");
    }
}


