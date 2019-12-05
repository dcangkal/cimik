<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();				
	}
	
	public function index()
	{		
		$data['form_action'] = site_url('auth/process_login');
		$data['register'] = site_url('auth/register');
		$data['forgetpassword'] = site_url('auth/forgetpassword');
		$this->load->view('auth/auth_login', $data);					
	}

	public function forgetpassword()
	{		
		$data['form_action'] = site_url('auth/process_forgetpassword');
		$data['login'] = site_url('auth');
		$this->load->view('auth/auth_forgetpassword', $data);			
	}

	public function process_forgetpassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$host = $this->config->item('host');
			$user = $this->config->item('user');
			$pass = $this->config->item('pass');
			$API = new Routeros_API();
			if ($API->connect($host,$user,$pass)) {
		    $email = $this->input->post('email');
		        if(isset($email))
		        {
		            $API->write("/tool/user-manager/user/getall",false);
		            $API->write('?email='.$email,true);
		            $READ = $API->read(false);
		            $ARRAY = $API->parseResponse($READ);
		            if(count($ARRAY)>0){
						$data['forgetdata'] = $ARRAY;

	                    $this->load->library('email');
					    $config = array();
					    $config['charset'] = 'utf-8';
					    $config['useragent'] = 'Codeigniter';
					    $config['protocol']= "smtp";
					    $config['mailtype']= "html";
					    $config['smtp_host']= "ssl://mail.cangkal.id";//pengaturan smtp
					    $config['smtp_port']= "465";
					    $config['smtp_timeout']= "400";
					    $config['smtp_user']= "dani@cangkal.id"; // isi dengan email kamu
					    $config['smtp_pass']= "Passw0rdd4n1"; // isi dengan password kamu
					    $config['crlf']="\r\n"; 
					    $config['newline']="\r\n"; 
					    $config['wordwrap'] = TRUE;
					    //memanggil library email dan set konfigurasi untuk pengiriman email
					   
					    $this->email->initialize($config);
					    //konfigurasi pengiriman
					    $this->email->from($config['smtp_user']);
					    $this->email->to($email);
					    $this->email->subject("DATA Akun VPN CiMiK");
					    $this->email->message(
					     "berikut data akun VPN CiMiK<br><br>
					     username : ".$data['forgetdata'][0]['username']."<br>
					     password : ".$data['forgetdata'][0]['password']."<br><br>");
					   }
					else {
						echo "<script>alert('email tidak terdaftar!');
	            			window.location = ('" . base_url() . "auth/forgetpassword');</script>";
					}
					

	            	if($this->email->send())
				    {
				       echo "<script>alert('data akun sudah dikirim ke email, silahkan cek email');
	            			window.location = ('" . base_url() . "auth');</script>";
				    }
							           
				}
			} 
	           
		}			
		else{
			$data['form_action'] = site_url('auth/process_forgetpassword');
			$data['forgetpassword'] = site_url('auth/forgetpassword');		
			$this->load->view('auth/auth_forgetpassword', $data);
		}
	}

	public function process_login(){
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$username = $this->input->post('username');
		$password = $this->input->post('password');			

		//$this->load->library('Routeros_API');
		$API = new Routeros_API();
		$API->connect($host, $user, $pass);
		//mengecek user&pass vpn
		$cekup = $API->comm("/tool/user-manager/user/print", array(
			"?username" => $username,
			"?password" => $password,
			));
		//$data['cekup'] = $cekup;
		//print_r($cekup);
		if(count($cekup)>0){
			$userlogin  = $cekup[0]['username'];
			$passlogin  = $cekup[0]['password'];
			//print_r($userlogin);
			$data = array(
				'userlogin' => $userlogin, 
				'passlogin' => $passlogin,  
				'login' => TRUE);
			$this->session->set_userdata($data);
			//print_r($data);	
			echo "<script>alert('Sukses Login!');
				window.location = ('" . base_url() . "home');</script>";
		}
		else{
			$this->session->set_flashdata('message', 'Login gagal. Pastikan username dan password yang Anda masukkan benar!');
			echo "<script>alert('Gagal Login!');
						window.location = ('" . base_url() . "auth');</script>";
			//redirect('login');
		}
		
	}
	
	public function logout(){
		$this->session->unset_userdata(array( 'userlogin'=>'', 'passlogin' => '','login' => FALSE));
		$this->session->sess_destroy();
		redirect('auth', 'refresh');
	}

	

	public function register()
	{		
		$data['form_action'] = site_url('auth/process_register');
		$data['login'] = site_url('auth');
		$this->load->view('auth/auth_register', $data);			
	}


	public function process_register()
	{
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('username_new', 'Username', 'required');	
		$this->form_validation->set_rules('password_new', 'Password', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$host = $this->config->item('host');
			$user = $this->config->item('user');
			$pass = $this->config->item('pass');
			$API = new Routeros_API();
			if ($API->connect($host,$user,$pass)) {
		    //Creacion Usuarios PPPoE Usermanager
		    $customer = "admin";
		    //$name = $_POST['name'];
		    $firstname = $this->input->post('first_name');
		    $lastname = $this->input->post('last_name');
		    $email = $this->input->post('email');
		    $phone = $this->input->post('phone');
		    $username_new = strtolower ($this->input->post('username_new'));
		    $password_new = $this->input->post('password_new');
		    $plan = "vpn-profile";
		    //$perfil = "5 minutos";
		    //$comentarios = $_POST['comentarios'];
		    //$fecha_activacion = date('Y-m-d');
		        if(isset($username_new) || isset($password_new))
		        {
		            //cek username dan email
		            $API->write("/tool/user-manager/user/getall",false);
		            $API->write('?username='.$username_new,true);
		            $READ = $API->read(false);
		            $ARRAY = $API->parseResponse($READ);
		            if(count($ARRAY)>0){ 
		                echo "<script>alert('username sudah ada!')</script>";
						redirect('auth/register','refresh');
		            }
		            $API->write("/tool/user-manager/user/getall",false);
		            $API->write('?email='.$email,true);
		            $READ = $API->read(false);
		            $ARRAY = $API->parseResponse($READ);
		            if(count($ARRAY)>0){
		                echo "<script>alert('email sudah digunakan!')</script>";
						redirect('auth/register','refresh');
		            }
		            else{
		            $API->write("/tool/user-manager/user/add",false);
		            $API->write("=customer=".$customer,false);
		            $API->write("=first-name=".$firstname,false);
		            $API->write("=last-name=".$lastname,false);
		            $API->write("=phone=".$phone,false);
		            $API->write("=email=".$email,false);
		            $API->write("=disabled=yes",false);
		            $API->write("=username=".$username_new,false);
		            $API->write("=password=".$password_new,true);
		            $READ = $API->read(false);
		            $created = "ya";
			            if ($created== "ya") {
			                // tambah profile
			                $API->write("/tool/user-manager/user/create-and-activate-profile",false);
			                $API->write("=numbers=".$username_new,false);
			                $API->write("=customer=".$customer,false);
			                $API->write("=profile=".$plan,true);
			                $READ = $API->read(false);

			                //$encrypted_id = md5($username_new);
			                $encrypted_id = base64_encode($username_new);

			                $this->load->library('email');
						    $config = array();
						    $config['charset'] = 'utf-8';
						    $config['useragent'] = 'Codeigniter';
						    $config['protocol']= "smtp";
						    $config['mailtype']= "html";
						    $config['smtp_host']= "ssl://mail.cangkal.id";//pengaturan smtp
						    $config['smtp_port']= "465";
						    $config['smtp_timeout']= "400";
						    $config['smtp_user']= "dani@cangkal.id"; // isi dengan email kamu
						    $config['smtp_pass']= "Passw0rdd4n1"; // isi dengan password kamu
						    $config['crlf']="\r\n"; 
						    $config['newline']="\r\n"; 
						    $config['wordwrap'] = TRUE;
						    //memanggil library email dan set konfigurasi untuk pengiriman email
						   
						    $this->email->initialize($config);
						    //konfigurasi pengiriman
						    $this->email->from($config['smtp_user']);
						    $this->email->to($email);
						    $this->email->subject("Verifikasi Akun VPN CiMiK");
						    $this->email->message(
						     "akun VPN berhasil dibuat.<br><br>
						     terimakasih telah melakuan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>"
						     .site_url("auth/verifikasi/$encrypted_id".
						     "<br><br>
						      WA ke <a href='https://wa.me/6281346341345'>081346341345</a> apabila ada kendala registrasi.<br> 
						      Dan Kamu sudah bisa login <a href='https://cimik.cangkal.id/home'>dashboard CiMiK</a> untuk memonitoring Akun.<br><br>"
						     )
						    );
							

			            	if($this->email->send())
						    {
						       echo "<script>alert('akun anda sudah dibuat, silahkan cek email');
			            			window.location = ('" . base_url() . "auth');</script>";
						    }else
						    {
						       echo "<script>alert('akun anda sudah dibuat, tetapi email tidak terkirim');
			            			window.location = ('" . base_url() . "auth');</script>";
						    }
									           
						} 
			            else {
			                echo "email tidak terkirim";
			            }
		            }
		        }
		        else{
		            echo("data ada salah");
		            $created = "tidak";
		            //$planed ="tidak";
		        	}
			}
			else{
			        echo "koneksi gagal";
			    }
		}			
		else
		{
			$data['form_action'] = site_url('auth/process_register');
			$data['register'] = site_url('auth/register');		
			$this->load->view('auth/auth_register', $data);
		}
	}

	public function verifikasi($key)
	{
		$host = $this->config->item('host');
		$user = $this->config->item('user');
		$pass = $this->config->item('pass');
		$API = new Routeros_API();						
		
		if ($API->connect($host,$user,$pass))
		{
			$verifikasi_user=base64_decode($key);
           	$API->write("/tool/user-manager/user/set",false);
			$API->write('=.id='.$verifikasi_user, false);
			$API->write("=disabled=no",true);
			$ARRAY = $API->read();
			$API->disconnect();
			 echo "<script>alert('akun berhasil diverifikasi');
            			window.location = ('" . base_url() . "auth');</script>";
	    }
	    else
	    {
            echo "<script>alert('akun gagal verifikasi');
            			window.location = ('" . base_url() . "auth');</script>";
			//redirect('login');
	    }
			
	}	

}
