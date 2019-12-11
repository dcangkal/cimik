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
      if(isset($data['info'][0]['ip-address'])){ 
        $ipaddress[] = $data['info'][0]['ip-address'];
      }
      
      //print_r ($ipaddress);
      if(isset($data['info'][0]['ip-address'])){ 
        $ipaddressonly = $data['info'][0]['ip-address'];
      }
     
      //echo "<br>";
      if(!(isset($ipaddressonly))){
        echo "<script>alert('ip-address belum di setting, get ip-address terlebih dahulu');
        window.location = ('" . base_url() . "home/ipaddress');</script>";
        }
      else{
        $nat = $API->comm("/ip/firewall/nat/print", array(
          "?comment"=> $username,
        ));
        $totalnat= count($nat);
        if ($totalnat > 0) {
          for ($i = 0; $i < $totalnat; $i++) {
            $toaddress[]=$nat[$i]['to-addresses'];
          }
          //print_r($toaddress);
          //echo "<br>";
          $result=count(array_diff($toaddress,$ipaddress));
          //print_r($result);
    
          if ($result != 0)
          {
            //echo "<br>";
            $getid= $API->comm("/ip/firewall/nat/print", array(
              "?comment"=> $username,
            ));
            $totalgetid= count($getid);
            for ($i = 0; $i < $totalgetid; $i++) {
              $id=$getid[$i]['.id'];
              $API->write("/ip/firewall/nat/set",false);
              $API->write('=.id='.$id, false);
              $API->write('=to-addresses='.$ipaddressonly,true);
              $API->read(false);
            }
            $API->disconnect();
                    echo "<script>alert('tunggu sebentar, menyamakan ip-address dengan to-addresses');
                    window.location = ('" . base_url() . "nat');</script>";
          }
          else
          {
            //echo "data sama";
            $API->write("/ip/firewall/nat/print",false);
            $API->write('?comment='.$username,true);
            $READ = $API->read(false);
            $ARRAY = $API->parseResponse($READ);
            $API->disconnect();
            $total_nat = count($READ);
            if ($total_nat > 0){
            $data['nat'] = $ARRAY;
            }
          }
        }
        else
        {
          //echo "data sama";
          $API->write("/ip/firewall/nat/print",false);
          $API->write('?comment='.$username,true);
          $READ = $API->read(false);
          $ARRAY = $API->parseResponse($READ);
          $API->disconnect();
          $total_nat = count($READ);
          if ($total_nat > 0){
          $data['nat'] = $ARRAY;
          }
        }
      }
      $data['link_action'] = site_url('nat/add');
		  $this->load->view('home/nat', $data);	      
		}
	}
        
    public function add()
	{	
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->session->userdata('userlogin');
		$password = $this->session->userdata('passlogin');

		$API = new Routeros_API();
		$API->connect($host,$user,$pass);
		//cek total port digunakan user max 10
		$API->write("/ip/firewall/nat/getall",false);
		$API->write('?comment='.$username,true);
		$READ = $API->read(false);
		$ARRAYPORT = $API->parseResponse($READ);
		if(count($ARRAYPORT)>9){ 
			echo "<script>alert('port remote sudah full!')</script>";
			redirect('nat','refresh');
		}
		else {
		//$API->connect($host,$user,$pass);
		$cekup = $API->comm("/ip/firewall/nat/print");
			$totalcekup = count($cekup);
			for ($i = 0; $i < $totalcekup; $i++) {
				if(isset($cekup[$i]['dst-port'])){ 
					$datacekup[]=$cekup[$i]['dst-port'];
				 }
			}
		//print_r($cekup);
			$awalport = 8000;
			$akhirport= 9000;
			for($port = $awalport; $port < $akhirport; $port++){
				$dataport[]=$port;
			}
			$data['resultport']=array_diff($dataport,$datacekup);

			$awalportavailable = 10;
			$akhirportavailable= 10000;
			for($portavailable = $awalportavailable; $portavailable < $akhirportavailable; $portavailable++){
				$dataportavailable[]=$portavailable;				
			}
			//print_r($dataportavailable);
			$data['resultportavailable']= $dataportavailable;	
			//print_r($data);					
		}
		//if ($API->connect($host,$user,$pass))
		//{
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
		//}
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
				
				//cek port
				$API->write("/ip/firewall/nat/getall",false);
				$API->write('?dst-port='.$dstport,true);
				$READ = $API->read(false);
				$ARRAY = $API->parseResponse($READ);
				if(count($ARRAY)>0){ 
					echo "<script>alert('port sudah digunakan!')</script>";
					redirect('nat/add','refresh');
				}
			    else {
					
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

	public function edit($key)
	{
		if(!(isset($key))){ 
			echo "<script>alert('tidak ada port remote yang diganti');
					window.location = ('" . base_url() . "nat');</script>";
		}
		else{
			$host = $this->config->item('host');
			$user = $this->config->item('user');
			$pass = $this->config->item('pass');
			$username = $this->session->userdata('userlogin');
			$password = $this->session->userdata('passlogin');
			//print_r($id);
			
			// print_r($key);
			$decode=base64_decode($key);
			// echo "<br>";
			// print_r($decode);		
		
			$API = new Routeros_API();
			$API->connect($host,$user,$pass);
			//get nat base id and commment
			$API->write("/ip/firewall/nat/print",false);
			$API->write('?.id='.$decode,false);
			$API->write('?comment='.$username,true);
			$READ = $API->read(false);
			$ARRAY = $API->parseResponse($READ);
			//$API->disconnect();
			$total_nat = count($READ);
			if ($total_nat > 0){
				$data['natedit'] = $ARRAY;
			}
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
			$awalportavailable = 10;
			$akhirportavailable= 10000;
			for($portavailable = $awalportavailable; $portavailable < $akhirportavailable; $portavailable++){
				$dataportavailable[]=$portavailable;				
			}
			//print_r($dataportavailable);
			$data['resultportavailable']= $dataportavailable;
			//print_r($data);
			//
			$data['form_action'] = site_url('nat/process_nat_edit');			
			$this->load->view('home/nat_edit', $data);
		}			
	}

	public function process_nat_edit()
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
				$id = $this->input->post('id');
			    //$chain = $this->input->post('chain');
                //$protocol = $this->input->post('protocol');
                //$dstport = $this->input->post('dst_port');
                //$action = $this->input->post('action');
                //$toaddresses = $this->input->post('to_addresses');
				$toports = $this->input->post('to_ports');
				
				//cek port
				$API->comm("/ip/firewall/nat/set", array(
					".id" => $id,
					"to-ports" =>$toports,
				));
				//$API->write("/ip/firewall/nat/set",false);
				//$API->write('?.id='.$id,false);
				//$API->write('?to-ports='.$toports,true);
				//$READ = $API->read(false);
				//$ARRAY = $API->parseResponse($READ);					
				//$API->disconnect();
				echo "<script>alert('port remote berhasil diganti');
					window.location = ('" . base_url() . "nat');</script>";
			}		    
		}	
	}

	public function delete($key)
	{
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->session->userdata('userlogin');
		$password = $this->session->userdata('passlogin');
		$decode=base64_decode($key);
		$API = new Routeros_API();	
		
		//print_r($id);
		//print_r($username);
		if(!(isset($key))){ 
			echo "<script>alert('tidak ada port remote yang dihapus');
					window.location = ('" . base_url() . "nat');</script>";
		}
		else{
			if ($API->connect($host,$user,$pass))
			{
				$API->write("/ip/firewall/nat/print",false);
				$API->write('?.id='.$decode,false);
				$API->write('?comment='.$username,true);
				$READ = $API->read(false);
				$ARRAY = $API->parseResponse($READ);
				//print_r($ARRAY);

				$total_results = count($READ);
				if ($total_results > 0){
					$data['info'] = $ARRAY;
					//remove port
					$remove = $API->comm("/ip/firewall/nat/remove", array(
						".id" => $decode,
					));
					echo "<script>alert('port remote berhasil dihapus');
						window.location = ('" . base_url() . "nat');</script>";
				}
				else{
					echo "<script>alert('tidak ada akses delete port ini');
						window.location = ('" . base_url() . "nat');</script>";
				}
				//print_r($data);
				
			}
		}				    
	}
}
