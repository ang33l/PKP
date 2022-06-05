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

    public function connections()
    {
        $header['page_title'] = "Połączenia"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->show();
        $this->load->view('/admin/connections',$data);
    }

    public function compartments()
    {
        $header['page_title'] = "Przedziały"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->model('Compartments_model');
        $data['records'] = array();
        foreach($this->Compartments_model->get_all_compartments()->result() as $row){
            array_push($data['records'], array(
                'compartment_id' => $row->compartment_id,
                'quantity_seats' => $row->quantity_seats,
                'type' => $row->type
            ));
        }
        $this->load->view('admin/compartments', $data);
    }

    public function compartmentAdd()
    {
        if(!$this->input->post('quantity_seats') || !$this->input->post('type')){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Brak danych!'
                )));
        }
        $seats = $this->input->post('quantity_seats');
        $type = $this->input->post('type');

        if($seats<1){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie może być mniej niż jedno miejsce w przedziale!'
                )));
        }

        $this->load->model('Compartments_model');
        $Compartments = $this->Compartments_model;

        return $Compartments->add_compartment($seats, $type);
    }

    public function compartmentDelete($id)
    {
        if($id<1){
            if(!$this->input->post('quantity_seats') || !$this->input->post('type')){
                return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Niepoprawne dane!'
                    )));
            }
        }
        $this->load->model('Compartments_model');
        $Compartments = $this->Compartments_model;
        $Compartments->delete_compartment($id);
        header("Location: ".base_url().'admin/compartments');
    }
}
