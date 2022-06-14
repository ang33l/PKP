<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
        $header['page_title'] = "Wyszukiwanie połączeń"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->view('/search/search');
	}

    function keyword()
    {
        $header['page_title'] = "Wyszukiwanie połączeń"; /* tytuł, który będzie widoczny na pasku */
        $header['nav_item'] = "search"; /* home / search / ticket / account */
        $this->load->library('form_validation');
        $this->form_validation->set_rules('from-where','skad','required');
        $this->form_validation->set_rules('to-where','dokad','required');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('header', $header);
            $this->load->view('/search/search');
        } else {
            $this->load->view('header', $header);
            $this->load->model('Search_model');

            $from=$this->input->post('from-where');
            $to=$this->input->post('to-where');
            $date=$this->input->post('depature-time');

            $data['records'] = $this->Search_model->search($from,$to,$date);
            $this->load->view('/search/describe',$data);
        }    
    }


    public function deleteconn($stops_id)
    {
        $this->load->model('Search_model');
        $this->Search_model->delete($stops_id);
        redirect(base_url().'admin/connections');
    }

    public function edit($id)
    {
        $header['page_title'] = "Edytuj bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->edit($id);
        $this->load->view('/admin/edit',$data);
    }

    public function update($id)
    {
        $header['page_title'] = "Edytuj bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $townn=$this->input->post('from-where');
        $daten=$this->input->post('depature-time');

        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->updatecon($townn,$daten,$id);
        redirect(base_url().'admin/connections');
        //$this->load->view('/search/edit',$data);
    }

    public function showConn()
    {
        $header['page_title'] = "Dodaj połączenie"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->pickconn();
        $this->load->view('admin/addconnection',$data);
    }

    public function addConn()
    {
        $header['page_title'] = "Dodaj połączenie"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $train_id=$this->input->post('train_id');
        $this->load->model('Search_model');
        $this->Search_model->addconn($train_id);
        redirect(base_url().'admin/connections');
    }
    
    public function showStops()
    {
        $header['page_title'] = "Dodaj przystanki"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);

        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->pickstops();
        $this->load->view('admin/addstops',$data);
    }

    public function addStops()
    {
        $town=$this->input->post('town');
        $date=$this->input->post('depature-time');
        $conn=$this->input->post('connection_id');
        $int=intval($conn);
        
        for($i=0; $i<count($town); $i++){
            $data[] = [
                'connection_id' => $int,
                'town' => $town[$i],
                'date' => $date[$i]
            ];
        }
        $result = $this->db->insert_batch('connections_stops',$data);
       
        redirect(base_url().'admin/connections');

    }
}
