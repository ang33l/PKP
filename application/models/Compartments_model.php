<?php

class Compartments_model extends CI_Model {
    public $compartment_id;
    public $quantity_seats;
    public $type;

    public function get_all_compartments()
    {
        $sql = "SELECT compartment_id, quantity_seats, type FROM compartment;";
        return $this->db->query($sql);
    }

    public function add_compartment($seats, $type)
    {
        $sql = "INSERT INTO compartment(compartment_id, quantity_seats, type) VALUES(DEFAULT, ?, ?);";
        $response = $this->db->query($sql, array($seats, $type));
        if($response){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie dodano nowy przedział!'
                )));
        } else{
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Błąd dodawania nowego przedziału do bazy!'
                )));
        }
    }

    public function delete_compartment($id)
    {
        $sql = "DELETE FROM compartment WHERE compartment_id=?;";
        $response = $this->db->query($sql, array($id));
        var_dump($response);
        return $response;
    }
}