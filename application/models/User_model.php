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
        $sql =  'SELECT user_id, user_name, password, user_type_id FROM user WHERE user_name=?;';
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

        $sql = 'INSERT INTO user (user_id, user_name, password, email, user_type_id, first_name, last_name) VALUES (DEFAULT, ?, ?, ?, ?, ?, ?);';
        $query = $this->db->query($sql, array(
            $this->login,
            password_hash($this->pass, PASSWORD_BCRYPT),
            $this->email,
            3,
            $this->first_name,
            $this->last_name
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
        $sql = 'SELECT email, first_name, last_name, user_name, ut.name FROM user u LEFT JOIN user_type ut ON u.user_type_id=ut.user_type_id WHERE user_id=?;';
        $query = $this->db->query($sql, array($this->session->user_id));
        return $query;
    }

    public function find_user($login)
    {
        $sql = 'SELECT user_id, email, user_name, ut.name, ut.user_type_id FROM user u LEFT JOIN user_type ut ON u.user_type_id=ut.user_type_id WHERE user_name=? OR email=?;';
        $query = $this->db->query($sql, array($login, $login));

        return $query;
    }  

    public function change_user_privilage($type, $user_id)
    {
        $sql = 'UPDATE user SET user_type_id=? WHERE user_id=?';
        return $this->db->query($sql, array($type, $user_id));
    }

    public function change_password($old, $new)
    {
        $sql = 'SELECT password FROM user WHERE user_id=?;';
        $query = $this->db->query($sql, array($this->session->user_id));
        foreach($query->result() as $row){
            if(password_verify($old, $row->password)){
                $sql = 'UPDATE user SET password=? WHERE user_id=?;';
                $query = $this->db->query($sql, array(
                    password_hash($new, PASSWORD_BCRYPT), 
                    $this->session->user_id
                ));
                return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie zmieniono hasło!'
                )));
            }
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Podane aktualne hasło jest nieprawidłowe!'
                )));
        }
        return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nieznaleziono hasła dla użytkownika!'
                )));
    }
    
    public function delete_user(){}
    
}