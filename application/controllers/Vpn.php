<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vpn extends CI_Controller {
	
	public function __construct(){
		parent::__construct();				
	}
	
	public function index()
	{
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$API = new Routeros_API();
		if ($API->connect($host,$user,$pass)) {
			$users_disabled = $API->comm("/tool/user-manager/user/print", array(
				      "count-only"=> "",
				      "?disabled"=> "yes",
				   ));
				   
		   	//print_r($ARRAY);
			//$disabled_results = $ARRAY;
			//print_r($disabled_results);
			$data['disabled_results'] = $users_disabled;
		
			$API->write('/tool/user-manager/user/getall');
			$users_total = $API->read();
			//$API->disconnect();
			//print_r($users_total);	
			$total_results = count($users_total);
			$data['total_results'] = $total_results;

			$users_active = $API->comm("/tool/user-manager/session/print", array(
				      "count-only"=> "",
				      "?active"=> "yes",
				   ));
				   
		   	//print_r($ARRAY);
			//$disabled_results = $ARRAY;
			//print_r($disabled_results);
			$data['active_results'] = $users_active;

			$resource = $API->comm("/system/resource/print");
			$data['resource'] = $resource;

		
			$API->disconnect();
		}
		else{
			echo ("koneksi gagal");
		}

		$data['login'] = site_url('auth');
		$data['register'] = site_url('auth/register');
		//$data['container'] = 'vpn/home';
		$this->load->view('front', $data);	
					
	}

}
