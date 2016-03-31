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
		$admin = $this->query_sql->select_array("admin","username,password","","","");
		if($this->input->post())
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			// echo "asdff";
			// die;
			$flag = 0;
			foreach($admin as $ad)
			{
				if($ad['username'] == $username && $ad['password'] == $password)
				{
					$flag = 1;
					break;
				}
			}
			if($flag == 1)
			{
				echo "dang nhap dung";
			}
			else echo "sai";
		}
		
		$this->load->view('backend/login/index');
	}

}
/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */