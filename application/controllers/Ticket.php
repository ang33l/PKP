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
        $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->view('ticket/buy');
	}

    public function summary()
    {
        $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->view('ticket/summary');
    }

    public function confirmation()
    {
        $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->view('/ticket/summary');
    }
    public function addToBase()
    {
        $payment=$this->input->post('payment');
        $numSeats=$this->input->post('numSeats');
        $user_id = $this->session->user_id;
        $id_connection = $this->session->connection_id;
        $from = $this->session->from;
        $where = $this->session->where;
        // $seats=$this->input->post('seats');

        $response=$this->Ticket_model->saverecords($numSeats, $user_id, $id_connection, $payment, $from, $where); 
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
        $header['page_title'] = "Moje bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
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
        $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $this->load->view('/ticket/payment');
        $this->Ticket_model->payTicket($ticketId);
    }

    public function showAllTickets()
    {
        $header['page_title'] = "Wszystkie bilety bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $data['records'] = $this->Ticket_model->showAll();
        $this->load->view('/ticket/showalltickets',$data);
    }
}