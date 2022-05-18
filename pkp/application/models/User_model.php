<?php

class User_model extends CI_Model {
    public $login;
    public $email;
    public $pass;
    public $first_name;
    public $last_name;
    public $user_id;
    public $user_privilage;

    public function change_password(){}
    public function change_user_privilage(){}
    public function delete_user(){}
    public function register_user(){}
}