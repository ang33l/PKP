<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
        $this->load->view('/home/search');
	}

    function keyword()
    {
        $this->load->model('Search_model');

        $from=$this->input->post('from-where');
        $to=$this->input->post('to-where');
        $date=$this->input->post('depature-time');

        $data['records'] = $this->Search_model->search($from, $to);
        $this->load->view('/home/describe',$data);
    }
}
