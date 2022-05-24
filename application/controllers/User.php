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

    public function account()
    {
        $this->load->model('User_model');
        $user = $this->User_model;
        $user->user_id = $this->session->user_id;
        $data['user_data'] = $user->get_user_data()->result()[0];
        $this->load->view('user/account', $data);
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
        if(!$this->verifyPostFromRegister()){
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Nieprawidłowy dane!'
                    )));
        }

        $this->load->model('User_model');
        $user = $this->User_model;
        $user->login = $this->input->post("login");
        $user->pass = $this->input->post("pass");
        $user->email = $this->input->post('email');
        $user->first_name = $this->input->post('firstname');
        $user->last_name = $this->input->post('lastname');

        $response = $user->register();
        return $response;
    }
    public function logout()
    {
        $this->session->sess_destroy();
        header("Location: ".base_url());
        die();
    }

    private function verifyPostFromRegister()
    {
        return $this->input->post('login') && $this->input->post('pass') &&
            $this->input->post('repass') && $this->input->post('email') &&
            $this->input->post('firstname') && $this->input->post('lastname') &&
            ($this->input->post('pass') == $this->input->post('repass'));
    }
}
