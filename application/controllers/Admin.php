<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$header['page_title'] = "Panel admina"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);

		$this->load->view('admin/index');
	}
    public function users()
    {
        $header['page_title'] = "Panel admina"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);

		$this->load->view('admin/users');
    }

    public function findUser()
    {
        if(!$this->input->post('login')){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Brak danych!'
                )));
        }
        $this->load->model('User_model');
        $user = $this->User_model;
        $response = $user->find_user($this->input->post('login'));
        
        if(!$response->result()){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie znaleziono użytkownika o podanym loginie/mailu!'
                )));
        }
        foreach($response->result() as $row){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Znaleziono użytkownika!',
                    'data' => array(
                        'user_name' => $row->user_name,
                        'email' => $row->email,
                        'user_type_id' => $row->user_type_id,
                        'user_type_name' => $row->name,
                        'user_id' => $row->user_id
                    )
                )));
        }
    }

    public function updateUserType()
    {
        if(!$this->input->post('type') || !$this->input->post('user_id')){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Brak danych!'
                )));
        }
        $this->load->model('User_model');
        $user = $this->User_model;
        $response = $user->change_user_privilage($this->input->post('type'),$this->input->post('user_id'));
        if(!$response){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie udało się zmienić uprawnień!'
                )));
        } else{
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie zmieniono uprawnienia!'
                )));
        }
    }
}
