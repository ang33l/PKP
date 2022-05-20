<?php

class User_model extends CI_Model {
    public $login;
    public $email;
    public $pass;
    public $first_name;
    public $last_name;
    public $user_id;
    public $user_privilage;

    public function login()
    {
        $sql =  'SELECT user_id, user_name, password FROM user WHERE user_name=?;';
        $query = $this->db->query($sql, array($this->login));
        return $query;
    }
    public function register()
    {
        $sql = 'SELECT user_id FROM user WHERE user_name=?;';
        $query = $this->db->query($sql, array($this->login));
        if($query->result()){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Podana nazwa użytkownika już istnieje!'
                )));
        }
        $sql = 'SELECT user_id FROM user WHERE email=?;';
        $query = $this->db->query($sql, array($this->email));
        if($query->result()){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Podany adres e-mail już istnieje!'
                )));
        }

        $sql = 'INSERT INTO user (user_id, user_name, password, email) VALUES (DEFAULT, ?, ?, ?);';
        $query = $this->db->query($sql, array(
            $this->login,
            password_hash($this->pass, PASSWORD_BCRYPT),
            $this->email
        ));
        return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie zarejestrowano w serwisie!'
                )));
    }

    public function get_user_data()
    {
        $sql = 'SELECT email, first_name, last_name, user_name, ut.name FROM user  INNER JOIN user_type ut WHERE user_id=?;';
        $query = $this->db->query($sql, array($this->session->user_id));
        return $query;
    }

    public function change_password(){}
    public function change_user_privilage(){}
    public function delete_user(){}
    
}