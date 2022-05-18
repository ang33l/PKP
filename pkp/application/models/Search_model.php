<?php

class Search_Model extends CI_Model {
    public function search($from, $to)
    {/*
        if($this->input->post('from-where') && $this->input->post('to-where')){
            $sql =  'SELECT from_where, to_where FROM connections 
            WHERE from_where=? AND to_where=?;';
            $query = $this->db->query($sql, array(
                $this->input->post('from-where'),
                $this->input->post('to-where')  
            ));  
        }


        */
        //$this->db->like('from_where', $key);
        //$query = $this ->db->get('connections');
        $from_date=$this->input->post('depature-time');
        $query=$this->db->query("SELECT from_where, to_where, arrive_time, depature_time, 
         hour_of_arrive, hour_of_depature FROM connections WHERE from_where='$from' AND to_where='$to'");
        return $query->result();
        
    }

}
