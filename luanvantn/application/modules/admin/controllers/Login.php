<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $admin = $this->query_sql->select_array("admin","username,password","","","");
		if($this->input->post())
		{
			// $username = $this->input->post('username');
			// $password = md5($this->input->post('password'));
			// $flag = 0;
			// foreach($admin as $ad)
			// {
			// 	if($ad['username'] == $username && $ad['password'] == $password)
			// 	{
			// 		$flag = 1;
			// 		break;
			// 	}
			// }
			// if($flag == 1)
			// {
			// 	$login  = array(
		 //        'username'  => $username
			// 	);
			// 	$this->session->set_userdata($login);	
			// 	redirect("admin/admin");		
			// }
			// else $data['error'] = 'invalid username or password';

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$user = $this->query_sql->select_row("admin","username,password",array('username'=>$username,'password'=>$password),"");
				if(!empty($user))
				{
					$login  = array(
			        'admin'  => $username,
			        'id_admin'		=> $user['id'],
					);
					$this->session->set_userdata($login);	
					redirect("admin/admin");		
				}
				else $data['error'] = 'invalid username or password';
		}	
		echo ($this->session->userdata('a'));	
		$this->load->view('backend/login/index',isset($data)?$data:"");
	}
	public function detroy_sess()
	{
		if($this->session->has_userdata('admin'))
		{ 
			$login  = array(
		        'admin'  => $username				
				);
			$this->session->unset_userdata('admin');
			redirect("admin/login");
		}
	}
}
/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */