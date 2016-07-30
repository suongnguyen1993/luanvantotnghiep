<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	/*
		-Hàm index hiển thị dữ liệu của Amin 
		# if check_login() = false thì chuyển về trang admin/login
		# $page = 1 là biến dùng phân trang
		# if check_login() == false thì quay lại trang login

		# $search là dữ liệu lấy từ from search

		# if $this->input->post() có dữa liệu đưa lên qua form thì gán dữ liệu được tìm kiếm thông qua search vào $data['admin'] xuất dữ liệu tìm kiếm
		# else thì phần trang (mỗi trang gồm 10 phần từ) hiển thị dữ liệu của admin vào $data['admin']
		
	*/
	public function index($page = 1)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Admin';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['admin'] = $this->query_sql
			->select_array("admin","*","","",array("username" =>"$search"));
		}
		else
		{
			
			$this->load->library('pagination');
			$config = $this->query_sql->_pagination();
			$config['base_url'] = base_url().'admin/admin/index/';
			$config['total_rows'] = $this->query_sql->total('admin');
			$config['uri_segment'] = 4;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$page = ($page > $total_page)?$total_page:$page;
			$page = (!isset($page) | $page <= 1)?1:$page;

			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['admin']= $this->query_sql
			->view('*',"admin",($page-1)*$config['per_page'],$config['per_page']);
		}
		$data['template']='backend/admin/index';
		$this->load->view('backend/layout/admin',$data);
	}

	/*
		-Hàm  add thêm 1 dòng dữ liệu 'fullname','username','email','password','created' cho bảng admin
		# if check_login() = false thì chuyển về trang admin/login
		# if có dữ liệu post từ form về thì:
		{
			-kiểm tra form_validation
			# $username là giá trị được lấy từ form
			# $user là giá trị được lấy từ csdl mà có $username 
			# if $user rỗng 
 
			@return thông báo lỗi và quay về trang admin/admin/add

			# thêm dữ liệu cho bảng
		}

		@return xuất thông báo và quay về trang redirect('admin/admin/index');


	*/
	public function add()
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['admin'] = $this->query_sql
			->select_array("admin","username","","","");
			
		

		$data['title'] = 'Manage Add Admin';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('fullname','Full name', 'required|min_length[6]');
				$this->form_validation->set_rules('username','User name','required|min_length[6]|trim');
				$this->form_validation->set_rules('email','Email', 'required|trim');
				$this->form_validation->set_rules('password','Password','required|min_length[6]|trim');
				if($this->form_validation->run()){

					$username = $this->input->post('username');
					$user = $this->query_sql->select_row("admin","username",array('username'=>$username),"");
					if(!empty($user))
					{
						$this->session->set_flashdata('error', 'Username is already exists');
						redirect('admin/admin/add');
					}
					
					$data = array(
						'fullname' => $this->input->post('fullname'), 
						'username' => $this->input->post('username'),
						'email'    => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
				$flag = $this->query_sql->add('admin',$data);				
				$this->session->set_flashdata('noice',1);	
				redirect('admin/admin/index');
				}
				
			}
		// end check
		$data['template']='backend/admin/add';
		$this->load->view('backend/layout/admin',$data);
		
	}

	/*
		-Hàm update() để cập nhật dữ liệu 'fullname','username','email','password','updated' cho 1 admin

		# $id là id của admin cần cập nhật
		# if có dữ liệu post thì
		{
			# kiểm tra form_validation
			# thêm dữ liệu cho cột
		}

		@return xuất thông báo quay về trang admin/admin/index
	*/
	public function update($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Update Admin';	
		$data['admin']= $this->query_sql->select_row('admin','fullname, username, email, password',array('id'=>$id),'');
		if($this->input->post())
		{
			$this->form_validation->set_rules('fullname','Full name', 'required|min_length[6]');
			$this->form_validation->set_rules('username','User name','required|min_length[6]|trim');
			$this->form_validation->set_rules('email','Email', 'required|trim');
			$this->form_validation->set_rules('password','Password','required|min_length[6]|trim');
			if($this->form_validation->run())
			{
				$data = array(
					'fullname' => $this->input->post('fullname'), 
					'username' => $this->input->post('username'),
					'email'    => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
							);
				$flag = $this->query_sql->edit('admin',$data,array('id' => $id));
				$this->session->set_flashdata('noice',2);
				redirect('admin/admin/index');
			}
		}
		$data['template']='backend/admin/edit';
		$this->load->view('backend/layout/admin',$data);
	}

	/*
		-Hàm delete xóa 1 admin ra khỏi csdl
		# $id là giá trị id của admin cần xóa
		# if check_login() = false thì chuyển về trang admin/login

		@return xóa 1 dòng trong dữ liệu, xuất thông báo và chuyển trang admin/admin/index
	*/
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$this->query_sql->del('admin',array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',3);
				redirect('admin/admin/index');
	}

	public function check_login ()
	{
		if($this->session->has_userdata('admin'))
			return true;
		else return false;
	}

}



/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */