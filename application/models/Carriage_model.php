<?php

class Carriage_model extends CI_Model {
    public $carriage_id;

    public function get_all_carriages()
    {
        $sql = 'SELECT cc.carriage_id, cc.compartment_id, c.quantity_seats FROM carriage_compartment cc INNER JOIN compartment c ON c.compartment_id=cc.compartment_id;';
        $result = $this->db->query($sql);

        return $result;
    }

    public function add_carriage()
    {
        $sql = 'INSERT INTO carriage(carriage_id) VALUES(DEFAULT);';
        $this->db->query($sql);
        $sql = 'SELECT MAX(carriage_id) as id FROM carriage;';
        $query = $this->db->query($sql);
        foreach($query->result() as $row){
            $response = $row->id;
        }
        return $response;
    }

    public function add_carriage_compartments($carriage_id, $compartments)
    {
        $sql = "INSERT INTO carriage_compartment (carriage_compartment_id, carriage_id, compartment_id) VALUES ";
        for($i=0; $i<count($compartments); $i++){
            $sql .= "(DEFAULT, " . intval($carriage_id) .",  " . intval($compartments[$i]) . ")";
            if($i == count($compartments)-1){
                $sql .= ";";
            } else {
                $sql .= ",";
            }
        }
        $response = $this->db->query($sql);

        return $response;
    }

    public function verify_compartments_existence($compartments)
    {
        $sql = "SELECT compartment_id FROM compartment;";
        $query = $this->db->query($sql);

        $dbData = array();
        foreach($query->result() as $row){
            array_push($dbData, $row->compartment_id);
        }
        foreach($compartments as $compartment){
            if(array_search($compartment, $dbData, TRUE) === FALSE){
                return false;
            }
        }
        return true;
    }

    public function delete_carriage($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM carriage_compartment WHERE carriage_id=?;";
        $response  = $this->db->query($sql, array($id));
        $sql = "DELETE FROM carriage WHERE carriage_id=?;";
        $response = $response && $this->db->query($sql, array($id));
        return $response;
    }

    public function verify_compartments_equals($id, $compartments)
    {
        $sql = "SELECT compartment_id FROM carriage_compartment WHERE carriage_id=?;";
        $query = $this->db->query($sql, array($id));

        $dbData = array();
        foreach($query->result() as $row){
            array_push($dbData, $row->compartment_id);
        }
        if($dbData == $compartments){
            return true;
        } else{ return false; }
    }

    public function update_carriage($id, $compartments)
    {
        $sql = "DELETE FROM carriage_compartment WHERE carriage_id=?;";
        $response = $this->db->query($sql, array($id));

        $addCompartments = $this->add_carriage_compartments($id, $compartments);

        $response = $response && $addCompartments;

        return $response;
    }
}