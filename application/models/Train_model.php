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
}