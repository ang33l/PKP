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
		$this->load->view('header', $header);
        $this->load->model('Search_model');

        $from=$this->input->post('from-where');
        $to=$this->input->post('to-where');
        $date=$this->input->post('depature-time');

        $data['records'] = $this->Search_model->search($from,$to,$date);
        $this->load->view('/search/describe',$data);
    }


    public function connections()
    {
        $header['page_title'] = "Edytuj bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "search"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->model('Search_model');
        $data['records'] = $this->Search_model->show();
        $this->load->view('/admin/connections',$data);
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
}
