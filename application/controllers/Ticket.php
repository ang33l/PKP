<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function buy()
	{
        $this->load->view('ticket/buy');
	}

    public function summary()
    {
        $this->load->view('ticket/summary');
    }
}
