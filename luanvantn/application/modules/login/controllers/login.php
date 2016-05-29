<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('facebook');
	}

	public function index()
	{
		$data['error'] = $this->session->flashdata('message');
		
		$data['facebook_login_url']=$this->facebook->get_login_url();
		$data['title'] = 'Đăng Nhập';
		$data['template'] = 'login';
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$user = $this->query_sql->select_array("user","username,password","","","");
		if($this->input->post())
		{
			if($this->check_validation())
			{
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$user = $this->query_sql->select_row("user","fullname,username,password,id,fb_id",array('username'=>$username,'password'=>$password),"");
				if(!empty($user))
				{
					$login  = array(
			        'username'  => $username,
			        'id'		=> $user['id']
					);
					$this->session->set_userdata($login);	
					redirect("index");		
				}
				else $data['error'] = 'Username hoặc password không đúng';
			}	
		}

		
		$this->load->view('frontend/layout/user',isset($data)?$data:"");						
	}
	public function detroy_sess()
	{
		if($this->session->has_userdata('username'))
		{ 
			$this->session->sess_destroy();
			redirect("index");
		}
	}

	private function check_validation()
	{
		$this->form_validation->set_rules('username','Username','trim|required|min_length[6]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
		return $this->form_validation->run();
	}
	public function check_login()
	{
		if($this->session->has_userdata('username'))
			echo '1';
		else
			echo '0';
		die;
	}
	public function handle_facebook_response(){
		$fb_data=$this->facebook->validate();
	//array to store data in database
		if(isset($fb_data))
		{
			$user = $this->query_sql->select_row("user","fullname,username,fb_id,id",array('fb_id'=>$fb_data['id']),"");
			if(!empty($user))
			{
				$session_data=array(
					'username'=>$fb_data['name'],
					'id'	  =>$user['id']
					);
				$this->session->set_userdata($session_data);
				redirect("index"); 	
			}
			else
			{
				$user=array(
					'id'	  => "",
					'fullname'=>$fb_data['name'],	
					'username'=>$fb_data['id'],
					'password'=> 0,
					'fb_id'	  =>$fb_data['id']
				);
				$adduser = $this->query_sql->add('user',$user);
				if($adduser == 0)
				{ 
					$this->session->set_flashdata('message','Lỗi sql');
					redirect(base_url('login/login'));
				}
				else
				{
					$a = $this->query_sql->select_row("user","fullname,username,fb_id,id",array('fb_id'=>$fb_data['id']),"");
					$session_data=array(
						'username'=>$fb_data['name'],
						'id'	  =>$a['id']	  	
						);				
					$this->session->set_userdata($session_data);
					redirect("index");
				}
			}
		}
		else
		{
			$this->session->set_flashdata('message','Lỗi trong quá trình đăng nhập facebook');
			redirect(base_url('login/login'));
		}
	}

}

/* End of file login.php */
/* Location: ./application/modules/login/controllers/login.php */