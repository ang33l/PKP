<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function login()
	{
		$this->load->view('user/login');
	}

    public function register()
    {
        $this->load->view('user/register');
    }

	public function verifyLogin()
	{
        if(!$this->input->post("login") || !$this->input->post("pass")){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nieprawidłowy login lub hasło!'
                )));
        }

        $this->load->model('User_model');
        $user = $this->User_model;
        $user->login = $this->input->post("login");
        $user->pass = $this->input->post("pass");

        $query = $user->login();

        if(!$query->result()){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nieprawidłowy login lub hasło!'
                )));
        }
        foreach($query->result() as $row){
            if(password_verify($this->input->post("pass"), $row->password)){
                $this->session->set_userdata(array(
                    'loggedIn' => true,
                    'user_id' => $row->user_id,
                    'user_name' => $row->user_name
                ));
                return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'success',
                        'message' => 'Pomyślnie zalogowano!'
                    )));
            } else {
                return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Nieprawidłowy login lub hasło!'
                    )));
            }
        }
	}


    public function verifyRegister()
    {
        if($this->input->post('login') && $this->input->post('pass') &&
        $this->input->post('repass') && $this->input->post('email') &&
        $this->input->post('firstname') && $this->input->post('lastname')){
            if($this->input->post('pass') == $this->input->post('repass')){
                $sql = 'INSERT INTO user (user_id, user_name, password) VALUES (DEFAULT, ?, ?);';
                $query = $this->db->query($sql, array(
                    $this->input->post('login'),
                    password_hash($this->input->post('pass'), PASSWORD_BCRYPT)
                ));
                echo "1";
                die();
            }
            else {
                echo "0";
                die();
            }
        }else{
            echo "0";
            die();
        }
        
    }
    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: ".base_url());
        die();
    }
}
