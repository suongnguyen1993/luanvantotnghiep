<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
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
	public function add()
	{
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
					foreach($data['admin'] as $username)
					{
						if($this->input->post('username')==$username['username'])
						{
							$this->session->set_flashdata('error', 'Username is already exists');
							redirect('admin/admin/add');
						}
					}
					$data = array(
						'fullname' => $this->input->post('fullname'), 
						'username' => $this->input->post('username'),
						'email'    => $this->input->post('email'),
						'password' => md5($this->input->post('password')),
						'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
				$flag = $this->query_sql->add('admin',$data);				
				$this->session->set_flashdata('noice',
				 '<div class="alert alert-success alert-dismissable text-center" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Add success!</strong>
				</div>');	
				redirect('admin/admin/index');
				}
				
			}
		// end check
		$data['template']='backend/admin/add';
		$this->load->view('backend/layout/admin',$data);
		
	}
	public function update($id)
	{
		$data['title'] = 'Manage Update Admin';	
		$data['admin']= $this->query_sql->select_row('admin','fullname, username, email, password',array('id'=>$id),'');
		if($this->input->post()){
		$data = array(
				'fullname' => $this->input->post('fullname'), 
				'username' => $this->input->post('username'),
				'email'    => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
		$flag = $this->query_sql->edit('admin',$data,array('id' => $id));
		$this->session->set_flashdata('noice',
					 '<div class="alert alert-success alert-dismissable text-center" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <strong>Updated success!</strong>
					</div>');
				redirect('admin/admin/index');
			}
		$data['template']='backend/admin/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		$this->query_sql->del('admin',array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',
					 '<div class="alert alert-success alert-dismissable text-center" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <strong>Deleted success!</strong>
					</div>');
				redirect('admin/admin/index');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */