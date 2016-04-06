<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		$data['title'] = 'Manage Group';
		$data['error'] = $this->session->flashdata('noice');
		$this->load->library('pagination');
		$config = $this->query_sql->_pagination();
		$config['base_url'] = base_url().'admin/group/index/';
		$config['total_rows'] = $this->query_sql->total('group');
		$config['uri_segment'] = 4;
		$total_page = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $total_page)?$total_page:$page;
		$page = (!isset($page) | $page <= 1)?1:$page;
		$this->pagination->initialize($config);
		$data['list_pagination'] = $this->pagination->create_links();
		$data['group']= $this->query_sql
		->view('*',"group",($page-1)*$config['per_page'],$config['per_page'] );

		//$data['group']= $this->query_sql->select_array('group','*','','','');
		$data['template']='backend/group/index';
		$this->load->view('backend/layout/admin',$data);
	}
	public function add()
	{
		// check form_validation
		$data['title'] = 'Manage Add Group';
			if($this->input->post()){
				$this->form_validation->set_rules('name','Group name', 'trim|required');
				if($this->form_validation->run()){
					$data = array(
						'name' => $this->input->post('name'), 
						'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
				$flag = $this->query_sql->add('group',$data);				
				$this->session->set_flashdata('noice',1);
				redirect('admin/group/index');
				}
				
			} 
		// end check
		
		$data['template']='backend/group/add';
		$this->load->view('backend/layout/admin',$data);
		
	}
	public function update($id)
	{
		$data['title'] = 'Manage Update Group';
		$data['group']= $this->query_sql->select_row('group','name, created',array('id'=>$id),'');
		if($this->input->post()){
			$this->form_validation->set_rules('name','Group name', 'trim|required');
			if($this->form_validation->run()){	
			$data = array(
					'name' => $this->input->post('name'),
					'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
							);
			$flag = $this->query_sql->edit('group',$data,array('id' => $id));
			$this->session->set_flashdata('noice',2);
					redirect('admin/group/index');
				}
		}
		$data['template']='backend/group/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		$this->query_sql->del('group',array('id' => $id));
		$this->session->set_flashdata('noice',3);
				redirect('admin/group/index');
	}

}

/* End of file group.php */
/* Location: ./application/controllers/admin/group.php */