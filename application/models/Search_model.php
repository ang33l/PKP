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

    public function show()
    {
        $query=$this->db->query("SELECT stops_id, town, date, connection_id FROM connections_stops ORDER BY connection_id, date ;");
    
        return $query->result();
    }

    public function delete($stop_id)
    {
        $query=$this->db->query("DELETE FROM connections_stops WHERE stops_id='$stop_id';");
    }

    public function edit($stop_id)
    {
        $query=$this->db->query("SELECT stops_id, town, date, connection_id FROM connections_stops WHERE stops_id='$stop_id';");
    
        return $query->result();
    }

    public function updatecon($town, $date, $stops_id)
    {
        $query=$this->db->query("UPDATE connections_stops SET town='$town', date='$date' WHERE stops_id='$stops_id';");
    }
}
