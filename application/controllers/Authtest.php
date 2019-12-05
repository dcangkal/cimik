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
}

	