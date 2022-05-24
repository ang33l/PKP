<?php

class Search_Model extends CI_Model {
    public function search($from, $to, $date)
    {
        $query=$this->db->query("SELECT town, date, connection_id FROM connections_stops WHERE town='$from' AND date>'$date';");
    
        $arr = array();
        foreach($query->result() as $row )
        {
            $sql2=$this->db->query("SELECT town, date, connection_id FROM connections_stops WHERE town='$to' AND connection_id='$row->connection_id';");
            foreach($sql2->result() as $r){
                array_push($arr, array(
                    'from' => $row->town,
                    'to' => $r->town,
                    'connection_id' => $r->connection_id,
                    'date_from' => $row->date,
                    'date_to' => $r->date,
                ));
            }
        }

        return $arr;
    }
}
