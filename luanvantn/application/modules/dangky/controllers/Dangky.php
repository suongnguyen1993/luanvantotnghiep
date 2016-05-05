<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dangky extends CI_Controller {

	public function index()
	{
		$data['title']= 'Đăng Ký';
		$data['template'] = 'dangky';
		$data['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		if($this->input->post())
		{
			if($this->checkValidation())
			{
				$fullname = $this->input->post('fullname');
				$email = $this->input->post('email');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$user = array(
						'id'	   => "",
						'fullname' => $fullname,
						'email'	   => $email,
						'username' => $username,
						'password' => md5($password),
						'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
				$this->query_sql->add('user',$user);
				if($this->query_sql->add('user',$user == 0))
				{
					$data['error'] = 'lỗi SQL';
				}			
			}
		}
		$this->load->view('frontend/layout/user',isset($data)?$data:"");	
	}


	private function checkValidation()
	{
		$password = $this->input->post('password');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|callback_check_username');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
		$this->form_validation->set_rules('repassword','Repassword',"trim|required|min_length[6]|matches[password]");
		return $this->form_validation->run();
	}


	private function check_username()
	{

     $post_username = $this->input->post('username');

     $username = $this->query_sql->select_array('user', 'username' ,'','','');
     $flag = 0;

	     foreach ($username as $user) 
	     {
	     	if($post_username == $user['username'])
	     	{
	     		$flag = 1;
	     		break;    		
		    }
		}
		if($flag == 0)
		{
			return true;
		}
		else 
		{
			$this->form_validation->set_message('check_username', 'Username đã tồn tại');
			return false;
		}    
	}


}

/* End of file Dangky.php */
/* Location: ./application/modules/dangky/controllers/Dangky.php */