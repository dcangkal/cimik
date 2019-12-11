<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nat extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		if ($this->session->userdata('login') == FALSE)
		{
			redirect('auth');
		}			
	}

	public function index()
	{	
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->session->userdata('userlogin');
		$password = $this->session->userdata('passlogin');
		$API = new Routeros_API();						
		
		if ($API->connect($host,$user,$pass))
		{
		    //mengecek user&pass vpn
            $API->write("/tool/user-manager/user/print",false);
            $API->write('?username='.$username,false);
            $API->write('?password='.$password,true);
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);

			$total_results = count($READ);
			if ($total_results > 0){
				$data['info'] = $ARRAY;
			}


            $API->write("/ip/firewall/nat/print",false);
            $API->write('?comment='.$username,true);
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);
            $API->disconnect();
			$total_nat = count($READ);
			if ($total_nat > 0){
				$data['nat'] = $ARRAY;
			}

			//print_r($data);

		}
		$this->load->view('home/nat', $data);	

        }
        
    public function add()
	{	
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->session->userdata('userlogin');
		$password = $this->session->userdata('passlogin');
		$API = new Routeros_API();						
		
		if ($API->connect($host,$user,$pass))
		{
		    //mengecek user&pass vpn
            $API->write("/tool/user-manager/user/print",false);
            $API->write('?username='.$username,false);
            $API->write('?password='.$password,true);
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);

			$total_results = count($READ);
			if ($total_results > 0){
				$data['info'] = $ARRAY;
			}	
			$data['form_action'] = site_url('nat/process_nat_add');
			$this->load->view('home/nat_add', $data);			
		}
    }
    
    public function process_nat_add()
	{
		$this->form_validation->set_rules('dst_port', 'dst-port', 'required');	
		$this->form_validation->set_rules('to_ports', 'to-ports', 'required');	
		
		if ($this->form_validation->run() == TRUE)
		{
			$host = $this->config->item('host');
			$user = $this->config->item('user');
			$pass = $this->config->item('pass');
			$username = $this->session->userdata('userlogin');
			$password = $this->session->userdata('passlogin');
			$API = new Routeros_API();						
			
			if ($API->connect($host,$user,$pass))
			{
			    $chain = $this->input->post('chain');
                $protocol = $this->input->post('protocol');
                $dstport = $this->input->post('dst_port');
                $action = $this->input->post('action');
                $toaddresses = $this->input->post('to_addresses');
                $toports = $this->input->post('to_ports');
			    
				$API->write("/ip/firewall/nat/add",false);
				$API->write('=comment='.$username, false);
				$API->write('=chain='.$chain, false);
				$API->write('=protocol='.$protocol, false);
				$API->write('=dst-port='.$dstport, false);
				$API->write('=action='.$action, false);
				$API->write('=to-addresses='.$toaddresses, false);
				$API->write('=to-ports='.$toports, true);
				$API->read(false);
				
				//$ARRAY = $API->read();
				//print_r($ARRAY);
				
				$API->disconnect();
							echo "<script>alert('port remote berhasil ditambahkan');
								window.location = ('" . base_url() . "nat');</script>";
			}		    
		}				
	}	

}
