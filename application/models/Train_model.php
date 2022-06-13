<?php

class Train_model extends CI_Model {
    public $train_id;
    public $carriace_count;
    public $carriage_schema;


    public function get_all_trains()
    {
        $sql = "SELECT  tc.train_id, SUM((SELECT SUM(c.quantity_seats) FROM carriage_compartment cc LEFT JOIN compartment c ON cc.compartment_id=c.compartment_id WHERE cc.carriage_id=tc.carriage_id)) AS sum_seats FROM train_carriage tc GROUP BY tc.train_id;";

        $query = $this->db->query($sql);

        return $query;
    }

    public function get_all_carriages()
    {
        $sql = "SELECT train_id, carriage_id FROM train_carriage;";
        $query = $this->db->query($sql);

        return $query;
    }

    public function get_carriages_for_modal()
    {
        $sql = "SELECT cc.carriage_id, SUM(c.quantity_seats) AS sum_seats FROM carriage_compartment cc INNER JOIN compartment c ON c.compartment_id=cc.compartment_id GROUP BY cc.carriage_id;";

        $query = $this->db->query($sql);

        return $query;
    }

    public function verify_carriages($carriages)
    {
        $sql = "SELECT carriage_id FROM carriage;";

        $query = $this->db->query($sql);
        $dbData = array();
        foreach($query->result() as $row){
            array_push($dbData, $row->carriage_id);
        }

        foreach($carriages as $c){
            if(array_search($c, $dbData, TRUE) === FALSE){
                return false;
            }
        }

        return true;
    }

    public function add_train($carriages){
        $sql = "INSERT INTO train(train_id) VALUES (DEFAULT);";
        $response = $this->db->query($sql);

        if(!$response){
            return false;
        }

        $sql = "SELECT MAX(train_id) AS id FROM train;";
        $train_id = "";
        $query = $this->db->query($sql);
        foreach($query->result() as $row){
            $train_id = $row->id;
        }
        
        $sql = "INSERT INTO train_carriage (train_carriage_id, train_id, carriage_id) VALUES ";
        for($i=0; $i<count($carriages); $i++){
            $sql .= "(DEFAULT, " . intval($train_id) .",  " . intval($carriages[$i]) . ")";
            if($i == count($carriages)-1){
                $sql .= ";";
            } else {
                $sql .= ",";
            }
        }
        $response = $this->db->query($sql);

        return $response;
    }

    public function delete_train($id)
    {
        $sql = "DELETE FROM train_carriage WHERE train_id=?;";

        $this->db->query($sql, array($id));

        $sql = "DELETE FROM train WHERE train_id=?;";

        $this->db->query($sql, array($id));
    }

    public function edit_train($train_id, $carriages)
    {
        $sql = "DELETE FROM train_carriage WHERE train_id=?";
        $this->db->query($sql, array($train_id));

        $sql = "INSERT INTO train_carriage (train_carriage_id, train_id, carriage_id) VALUES ";
        for($i=0; $i<count($carriages); $i++){
            $sql .= "(DEFAULT, " . intval($train_id) .",  " . intval($carriages[$i]) . ")";
            if($i == count($carriages)-1){
                $sql .= ";";
            } else {
                $sql .= ",";
            }
        }
        $response = $this->db->query($sql);

        return $response;
    }
}