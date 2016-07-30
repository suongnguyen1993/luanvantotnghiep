<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	/*
		-Hàm index để đăng nhập vào admin

		@ $username lấy giá trị username trong form
		@ $password lấy giá trị password trong form và mã hóa lại
		@ $user lấy dữ liệu trong csdl mà có username mà password đã đươc lấy từ form

		# if $user khác rỗng thì lưu dữ liệu vào sesstion
		# else xuất ra thông báo 
	*/
	public function index()
	{
		if($this->input->post())
		{

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$user = $this->query_sql->select_row("admin","username,password",array('username'=>$username,'password'=>$password),"");
				if(!empty($user))
				{
					$login  = array(
			        'admin'  => $username,
			        'id'		=> $user['id'],
					);
					$this->session->set_userdata($login);	
					redirect("admin/admin");		
				}
				else $data['error'] = 'invalid username or password';
		}	
		echo ($this->session->userdata('a'));	
		$this->load->view('backend/login/index',isset($data)?$data:"");
	}

	/*
		- Hàm detroy_sess hủy sesstion khi đăng nhập dùng để đăng xuất
		# if có tồn tại session 'admin' thì hủy session chuyển về trong login
	*/
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