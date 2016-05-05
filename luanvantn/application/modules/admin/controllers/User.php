<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage User';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['user'] = $this->query_sql
			->select_array("user","*","","",array("username" =>"$search"));
		}
		else
		{
			
			$this->load->library('pagination');
			$config = $this->query_sql->_pagination();
			$config['base_url'] = base_url().'admin/user/index/';
			$config['total_rows'] = $this->query_sql->total('user');
			$config['uri_segment'] = 4;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$page = ($page > $total_page)?$total_page:$page;
			$page = (!isset($page) | $page <= 1)?1:$page;

			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['user']= $this->query_sql
			->view('*',"user",($page-1)*$config['per_page'],$config['per_page']);
		}
		$data['template']='backend/user/index';
		$this->load->view('backend/layout/admin',$data);
	}
	public function add()
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['user'] = $this->query_sql
			->select_array("user","username","","","");
			
		

		$data['title'] = 'Manage Add User';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('fullname','Full name', 'required|min_length[6]');
				$this->form_validation->set_rules('username','User name','required|min_length[6]|trim');
				$this->form_validation->set_rules('email','Email', 'required|trim');
				$this->form_validation->set_rules('password','Password','required|min_length[6]|trim');
				if($this->form_validation->run()){
					foreach($data['user'] as $username)
					{
						if($this->input->post('username')==$username['username'])
						{
							$this->session->set_flashdata('error', 'Username is already exists');
							redirect('admin/user/add');
						}
					}
					$data = array(
						'fullname' => $this->input->post('fullname'), 
						'username' => $this->input->post('username'),
						'email'    => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
				$flag = $this->query_sql->add('user',$data);				
				$this->session->set_flashdata('noice',1);	
				redirect('admin/user/index');
				}
				
			}
		// end check
		$data['template']='backend/user/add';
		$this->load->view('backend/layout/admin',$data);
		
	}
	public function update($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Update User';	
		$data['user']= $this->query_sql->select_row('user','fullname, username, email, password',array('id'=>$id),'');
		if($this->input->post()){
			$this->form_validation->set_rules('fullname','Full name', 'required|min_length[6]');
			$this->form_validation->set_rules('username','User name','required|min_length[6]|trim');
			$this->form_validation->set_rules('email','Email', 'required|trim');
			$this->form_validation->set_rules('password','Password','required|min_length[6]|trim');
			if($this->form_validation->run()){
				$data = array(
						'fullname' => $this->input->post('fullname'), 
						'username' => $this->input->post('username'),
						'email'    => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
								);
				$flag = $this->query_sql->edit('user',$data,array('id' => $id));
				$this->session->set_flashdata('noice',2);
						redirect('admin/user/index');
					}
		}
		$data['template']='backend/user/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$this->query_sql->del('user',array('id' => $id));
		$this->session->set_flashdata('noice',3);
				redirect('admin/user/index');
	}

	public function check_login ()
	{
		if($this->session->has_userdata('username'))
			return true;
		else return false;
	}


}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */