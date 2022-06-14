<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->loggedIn){
            header("Location: ".base_url());
            die();
        } else{
            if($this->session->user_type_id>2){
                header("Location: ".base_url());
                die();
            }
        }
    }
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
        if($this->input->post('user_id') == 1){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie masz uprawnień, aby zmienić typ tego użytkownika!'
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

    public function compartmentEdit()
    {
        if(!$this->input->post('quantity_seats') || 
        !$this->input->post('type') ||
        !$this->input->post('compartment_id')){
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Niepoprawne dane!'
                    )));
        }
        $post = array(
            'compartment_id' => $this->input->post('compartment_id'),
            'quantity_seats' => $this->input->post('quantity_seats'),
            'type' => $this->input->post('type')
        );
        
        $this->load->model('Compartments_model');
        $Compartments = $this->Compartments_model;
        $data = $Compartments->get_one_compartment($post['compartment_id'])[0];
        if(!array_diff($post, $data)){
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Aby zmienić dane, muszą się one różnić!'
                    )));
        }
        $update = $Compartments->update_compartment($post['compartment_id'],$post['quantity_seats'], $post['type']);
        if($update){
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'success',
                        'message' => 'Pomyślnie zaktualizowano przedział!'
                    )));
        } else {
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Nie udało się zaktualizować przedziału!'
                    )));
        }
    }

    public function carriages()
    {
        $header['page_title'] = "Wagony"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $this->load->model('Carriage_model');
        $data['records'] = array();
        foreach($this->Carriage_model->get_all_carriages()->result() as $row){
            if(!isset($data['records'][$row->carriage_id])){
                $data['records'][$row->carriage_id] = array('compartments' => array());
                $data['records'][$row->carriage_id]['summedSeats'] = 0;
            }
            array_push($data['records'][$row->carriage_id]['compartments'], array(
                'compartment' => $row->compartment_id,
                'seats' => $row->quantity_seats 
            ));
            $data['records'][$row->carriage_id]['summedSeats'] += $row->quantity_seats;

        }
        foreach($data['records'] as $index => $row){
            $data['records'][$index]['summedCompartments'] = count($row['compartments']);
        }

        $this->load->model('Compartments_model');
        $data['compartments'] = array();
        foreach($this->Compartments_model->get_all_compartments()->result() as $row){
            array_push($data['compartments'], array(
                'compartment_id' => $row->compartment_id,
                'quantity_seats' => $row->quantity_seats,
                'type' => $row->type
            ));
        }

        $this->load->view('admin/carriages', $data);
    }

    public function carriageAdd()
    {
        if(!$this->input->post('compartments')){
            return $this->output->set_content_type('application/json', 'utf-8')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'type' => 'danger',
                        'message' => 'Niepoprawne dane!'
                    )));
        }
        $this->load->model('Carriage_model');
        $carriage_id = $this->Carriage_model->add_carriage();
        $compartments = explode(',',str_replace(' ', '', $this->input->post('compartments')));

        if(!$this->Carriage_model->verify_compartments_existence($compartments)){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Nie można dadać przedziału, który nie istnieje!'
            )));
        }

        $response = $this->Carriage_model->add_carriage_compartments($carriage_id, $compartments);

        if($response){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'success',
                'message' => 'Pomyślnie dodano nowy wagon!'
            )));
        } else{
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Nie udało się dodać wagonu!'
            )));
        }
    }

    public function carriageDelete($id)
    {
        if($id<1){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Niepoprawne dane!'
            )));
        }

        $this->load->model('Carriage_model');
        $this->Carriage_model->delete_carriage($id);
        
        header("Location: ".base_url().'admin/carriages');
    }

    public function carriageEdit()
    {
        if(!$this->input->post('compartments') || !$this->input->post('carriage_id')){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Niepoprawne dane!'
            )));
        }
        $this->load->model('Carriage_model');
        $carriage_id = $this->input->post('carriage_id');
        $compartments = explode(',',str_replace(' ', '', $this->input->post('compartments')));

        if(!$this->Carriage_model->verify_compartments_existence($compartments)){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Nie można dadać przedziału, który nie istnieje!'
            )));
        }

        if($this->Carriage_model->verify_compartments_equals($carriage_id, $compartments)){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Aby zmienić dane, muszą się one różnić!'
            )));
        }

        $response = $this->Carriage_model->update_carriage($carriage_id, $compartments);

        if($response){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'success',
                'message' => 'Pomyślnie zmieniono przedziały!'
            )));
        }else{
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Nie udało się zmienić przedziałów w bazie!'
            )));
        }
    }
    public function tickets()
    {
        $this->load->model('Ticket_model');
        $header['page_title'] = "Wszystkie bilety bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $this->load->library('Pagination_bootstrap');

        $sql = $this->db->query("SELECT t.ticket_id, user.user_name, t.connection_id, t.position, t.active, t.buytime, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = t.end) AS end, t.payment FROM tickets t INNER JOIN user ON t.user_id=user.user_id INNER JOIN user_type ON user.user_type_id = user_type.user_type_id WHERE user_type.name = 'head_admin' AND active=1 ORDER BY t.buytime DESC, t.ticket_id DESC; ");
        $url = base_url('admin/tickets/page');
        $this->pagination_bootstrap->offset(20);
        $data['records'] = $this->pagination_bootstrap->config($url,$sql);
        if($this->pagination_bootstrap->config($url,$sql) == 1) {
            $data['records'] = $this->Ticket_model->showAll();
        }
        $this->load->view('/admin/tickets',$data);
    }
    public function cancel($ticketId)
    {
        $this->load->model('Ticket_model');
        $this->Ticket_model->cancelTicket($ticketId);
        $url = base_url('admin/tickets/page');
        redirect($url);
    }

    public function trains()
    {
        $header['page_title'] = "Zarządzanie pociągami"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "admin"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->model('Train_model');
        $response = $this->Train_model->get_all_trains();

        $data['records'] = array();

        foreach($response->result() as $row){
            array_push($data['records'], array(
                'train_id' => $row->train_id,
                'sum_seats' => $row->sum_seats
            ));
        }
        $response = $this->Train_model->get_all_carriages();
        $data['carriages'] = array();

        foreach($response->result()  as $row){
            if(!isset($data['carriages'][$row->train_id])){
                $data['carriages'][$row->train_id] = array();
            }
            array_push($data['carriages'][$row->train_id], $row->carriage_id);
        }

        $response = $this->Train_model->get_carriages_for_modal();
        $data['modal'] = array();

        foreach($response->result()  as $row){
            $data['modal'][$row->carriage_id] = $row->sum_seats;
        }

        $this->load->view('/admin/trains',$data);
    }

    public function trainAdd()
    {
        if(!$this->input->post('carriages')){
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Błędne dane!'
            )));
        }

        $this->load->model('Train_model');
        $carriages = explode(',',str_replace(' ', '', $this->input->post('carriages')));

        $response = $this->Train_model->verify_carriages($carriages);

        if($response){
            $response = $this->Train_model->add_train($carriages);
            if($response){
                return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie dodano pociąg!'
                )));
            } else{
                return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie udało się dodać pociągu do bazy!'
                )));
            }
        } else {
            return $this->output->set_content_type('application/json', 'utf-8')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'type' => 'danger',
                'message' => 'Podany wagon nie istnieje!'
            )));
        }
    }

    public function trainDelete($id)
    {
        if($id<1){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Błędne dane!'
                )));
        }

        $this->load->model('Train_model');

        $this->Train_model->delete_train($id);

        header("Location: ".base_url().'admin/trains');
    }

    public function trainEdit()
    {
        if(!$this->input->post('train_id') || !$this->input->post('carriages')){
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Błędne dane!'
                )));
        }
        $this->load->model("Train_model");
        $train_id = $this->input->post('train_id');
        $carriages = explode(',',str_replace(' ', '', $this->input->post('carriages')));

        $response = $this->Train_model->verify_carriages($carriages);

        if($response){
            $response = $this->Train_model->edit_train($train_id, $carriages);
            if($response){
                return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'success',
                    'message' => 'Pomyślnie zmodyfikowano pociąg!'
                )));
            } else {
                return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Nie udało się zmodyfikować pociągu!'
                )));
            }
        } else {
            return $this->output->set_content_type('application/json', 'utf-8')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'type' => 'danger',
                    'message' => 'Podany wagon nie istnieje!'
                )));
        }
    }
}
