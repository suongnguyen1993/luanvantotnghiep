<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
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
				$flag = 0;
				foreach($user as $u)
				{
					if($u['username'] == $username && $u['password'] == $password)
					{
						$flag = 1;
						break;
					}
				}
				if($flag == 1)
				{
					$login  = array(
			        'username'  => $username
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
			$login  = array(
		        'username'  => $username				
				);
			$this->session->unset_userdata('username');
			redirect("index");
		}
	}

	private function check_validation()
	{
		$this->form_validation->set_rules('username','Username','trim|required|min_length[6]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
		return $this->form_validation->run();
	}

}

/* End of file login.php */
/* Location: ./application/modules/login/controllers/login.php */