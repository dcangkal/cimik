<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authtest extends CI_Controller {
	
	public function __construct(){
        parent::__construct();

	}
	
	public function index()
	{
        $host = $this->config->item('host');
        $user = $this->config->item('user');
        $pass = $this->config->item('pass');
        $username = 'dani';
		$password = 'ok';		

		//$this->load->library('Routeros_API');
		$API = new Routeros_API();						
			
		if ($API->connect($host,$user,$pass)){
            $cekup = $API->comm("/tool/user-manager/user/print", array(
                "?username" => "$username",
                "?password" => "$password",
              ));
              $data['cekup'] = $cekup;
              print_r($data);
        }		
        //$host = $this->config->item('host');
        //print_r($host);
							
    }

  public function listport()
	{
        $host = $this->config->item('host');
        $user = $this->config->item('user');
        $pass = $this->config->item('pass');
        $username = 'dani';
		$password = 'ok';		

		//$this->load->library('Routeros_API');
		$API = new Routeros_API();						
			
		if ($API->connect($host,$user,$pass)){
            $cekup = $API->comm("/ip/firewall/nat/print");
              //print_r($cekup);
              $totalcekup = count($cekup);
              for ($i = 0; $i < $totalcekup; $i++) {
                $datacekup[]=$cekup[$i]['dst-port'];
              }
              //$datacekup[]=$cekup[$i]['dst-port'];
              print_r ($datacekup);
              //print_r($data);
              echo "<br>";
              $awalport = 8000;
              $akhirport= 9000;
              for($port = $awalport; $port < $akhirport; $port++){
                  $dataport[]=$port;
              }
              //$dataport[] = $port;              
              print_r ($dataport);
              echo "<br>";
              $result=array_diff($dataport,$datacekup);
              print_r($result);
              foreach ($result as $val){ 
                echo $val. "\n"; 
                //echo "<option>$val</option>";
              } 
              echo "<br>";
              $cekip = $API->comm("/tool/user-manager/user/print");
              //print_r($cekip);
              $totalcekip = count($cekip);
              for ($i = 0; $i < $totalcekip; $i++) {
                print_r( $cekip[$i]['ip-address']);
              }
              echo "<br>";
                $awalip = ip2long('172.16.0.1');
                $akhirip = ip2long('172.16.2.1');  
                for ($ip = $awalip; $ip < $akhirip; $ip++ ) {
                    print_r(long2ip($ip));
                }                
        }		
        //$host = $this->config->item('host');
        //print_r($host);
							
    }

  public function delete($id)
	{
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->session->userdata('userlogin');
		$password = $this->session->userdata('passlogin');
		$API = new Routeros_API();						
		
		if ($API->connect($host,$user,$pass))
		{
			//$id = $this->input->post('id');
			//$chain = $this->input->post('chain');
			//$protocol = $this->input->post('protocol');
			//$dstport = $this->input->post('dst_port');
			//$action = $this->input->post('action');
			//$toaddresses = $this->input->post('to_addresses');
			//$toports = $this->input->post('to_ports');
			//print_r($id);
			//remove port
			$remove = $API->comm("/ip/firewall/nat/remove", array(
				".id" => $id,
			));

			//$API->write("/ip/firewall/nat/set",false);
			//$API->write('?.id='.$id,false);
			//$API->write('?to-ports='.$toports,true);
			//$READ = $API->read(false);
			//$ARRAY = $API->parseResponse($READ);					
			//$API->disconnect();
			echo "<script>alert('port remote berhasil dihapus');
				window.location = ('" . base_url() . "nat');</script>";
		}		    
  }
  
  public function natlist()
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

    
}