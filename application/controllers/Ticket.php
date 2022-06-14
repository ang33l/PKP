<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ticket_model');
        $this->load->library('form_validation');
        //$this->load->helper('url');
        //$this->load->model('authors_model');
        //$this->load->library("pagination");

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
        
        //$this->load->library('form_validation');
        $this->form_validation->set_rules('numSeats', 'Ilość miejsc', 'required');
        $this->form_validation->set_rules('payment', 'płatność', 'required');
        
        if ($this->form_validation->run() == TRUE ) {
            echo "Form is validated";
            $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
            $header['nav_item'] = "ticket"; /* home / search / ticket / account */
            // sprawdzenie wlnych miejsc
            $numSeats=$this->input->post('numSeats');
            $id_connection = $this->session->connection_id;
            $id_start = $this->session->id_start;
            $id_end = $this->session->id_end;
            $wolne['records']=$this->Ticket_model->quantity($numSeats, $id_connection, $id_start, $id_end); 
            $cost['row_cost']=$this->Ticket_model->cost($id_connection, $id_start, $id_end); 
            $this->load->view('header', $header);
            //$data = array_merge($wolne, $koszt);
            $this->load->view('/ticket/summary',$wolne + $cost);
        } else {
            header("Location: ".base_url()."search");
        }
    }
    public function addToBase()
    {
            $this->form_validation->set_rules('blikCode', 'blik', 'required');
            if ($this->form_validation->run() == FALSE AND $this->input->post('payment') == 1) {
                header("Location: ".base_url()."search");
            } else {
                $payment=$this->input->post('payment');
                $numSeats=$this->input->post('numSeats');
                $user_id = $this->session->user_id;
                $id_connection = $this->session->connection_id;
                $id_start = $this->session->id_start;
                $id_end = $this->session->id_end;
                $from = $this->session->from;
                $where = $this->session->where;
                // $seats=$this->input->post('seats');

                $response=$this->Ticket_model->saverecords($numSeats, $user_id, $id_connection, $payment, $id_start, $id_end); 
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
    }
    public function myTickets()
    {
        $header['page_title'] = "Moje bilety"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
		$this->load->view('header', $header);
        $user_id = $this->session->user_id;

        $this->load->library('Pagination_bootstrap');

        $sql=$this->db->query("SELECT COUNT(*) AS ilosc, `ticket_id`, `user_id`, `connection_id`, `position`, `active`, `buytime`, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = start) AS start, (SELECT connections_stops.town FROM connections_stops WHERE stops_id = end) AS end, (SELECT connections_stops.date FROM connections_stops WHERE stops_id = start) AS date, `payment` FROM `tickets` WHERE `active`=1 AND `user_id`=$user_id GROUP BY buytime ORDER BY BUYTIME DESC" );
        $url = base_url('ticket/mytickets/page');
        $this->pagination_bootstrap->offset(8);

        $data['records'] = $this->pagination_bootstrap->config($url,$sql);
        if($this->pagination_bootstrap->config($url,$sql) == 1) {
            $data['records'] = $this->Ticket_model->show($user_id);
        }
        $this->load->view('/ticket/mytickets',$data);
    }

    public function cancel($ticketId)
    {
        $this->Ticket_model->cancelTicket($ticketId);
        redirect(base_url().'ticket/details/'.$ticketId);
    }
    public function cancelAll($ticketId)
    {
        $this->Ticket_model->cancelAllTicket($ticketId);
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
    
    public function details($ticket_id)
    {
        $header['page_title'] = "Kupno biletu"; /* tytuł, który będzie widoczny na pasku */
		$header['nav_item'] = "ticket"; /* home / search / ticket / account */
        $user_id = $this->session->user_id;
		$this->load->view('header', $header);
        $data['records'] = $this->Ticket_model->ticketsDetails($user_id, $ticket_id);

        $this->load->view('/ticket/ticketsdetails',$data);
        
    }
}