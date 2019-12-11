<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
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

            $resource = $API->comm("/system/resource/print");
			$data['resource'] = $resource;

			$online = $API->comm("/tool/user-manager/session/print", array(
				      "count-only"=> "",
				      "?active"=> "yes",
				      "?user"=>$username,
				   ));
				   
		   	//print_r($online);
			//$disabled_results = $ARRAY;
			//print_r($disabled_results);
			$data['online'] = $online;

            $API->disconnect();
			$total_results = count($READ);
			if ($total_results > 0){
				$data['info'] = $ARRAY;
				//print_r($data['info']);
				//print_r($data);

			}

			
		}
		$this->load->view('home/dashboard', $data);					
	}	

	public function password()
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
			$data['form_action'] = site_url('home/process_password');
			$this->load->view('home/home_password', $data);			
		}
	}

	public function process_password()
	{
		$this->form_validation->set_rules('password_baru', 'Password', 'required');	
		$this->form_validation->set_rules('password_baru2', 'Confirm Password', 'required');	
		
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
			    $password1 = $this->input->post('password_baru');
			    $password2 = $this->input->post('password_baru2');
			    
			        if($password1 == $password2)
			        {
			        	$API->write("/tool/user-manager/user/set",false);
						$API->write('=.id='.$username, false);
						$API->write('=password='.$password2);
						
						$ARRAY = $API->read();
						print_r($ARRAY);
						
						$API->disconnect();
								 echo "<script>alert('password anda berhasil dirubah');
				            			window.location = ('" . base_url() . "auth/logout');</script>";
				            		}
				    else{
				            echo "<script>alert('password tidak sama!');
				            			window.location = ('" . base_url() . "home/password');</script>";
							//redirect('login');
				        }
				
			}
		}

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
			$data['form_action'] = site_url('home/process_password');
			$this->load->view('home/home_password', $data);			
		}					
	}	
}
