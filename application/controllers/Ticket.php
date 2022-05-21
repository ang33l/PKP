<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ticket_model');

    }
	public function buy()
	{
        $this->load->view('ticket/buy');
	}

    public function summary()
    {
        $this->load->view('ticket/summary');
    }

    public function confirmation()
    {
        $this->load->view('/ticket/summary');
    }
    public function addToBase()
    {
        $payment=$this->input->post('payment');
        $numSeats=$this->input->post('numSeats');
        $user_id = $this->session->user_id;
        $seats=$this->input->post('seats');

        $response=$this->Ticket_model->saverecords($seats, $user_id, $payment); 
        if($response==true) {
            ?>
                
            <script type="text/javascript">
                    alert("Zakup zrealizowany!");
                        
                </script>
            <?php
            //echo "Records Saved Successfully";
        } else {
            echo "Insert error !";
        }
        
        header("Location: ".base_url()."ticket/mytickets");
    }
    public function myTickets()
    {
        $user_id = $this->session->user_id;
        $data['records'] = $this->Ticket_model->show($user_id);
        $this->load->view('/ticket/mytickets',$data);
    }

    public function cancel($ticketId)
    {
        $this->Ticket_model->cancelTicket($ticketId);
        redirect(base_url().'ticket/mytickets');
    }
    public function pay($ticketId)
    {
        $this->load->view('/ticket/payment');
        $this->Ticket_model->payTicket($ticketId);
    }
}