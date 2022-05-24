<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$header['page_title'] = "Strona główna"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "home"; /* home / search / ticket / account */
		$this->load->view('header', $header);

		$this->load->view('home/index');
	}
}
