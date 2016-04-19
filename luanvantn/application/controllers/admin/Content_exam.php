<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_exam extends CI_Controller {

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
		$data['title'] = 'Manage Content_exam';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['exam'] = $this->query_sql
			->select_array("exam","*","","",array("info" =>"$search"));
		}
		else
		{
			
			$this->load->library('pagination');
			$config = $this->query_sql->_pagination();
			$config['base_url'] = base_url().'admin/exam/index/';
			$config['total_rows'] = $this->query_sql->total('exam');
			$config['uri_segment'] = 4;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$page = ($page > $total_page)?$total_page:$page;
			$page = (!isset($page) | $page <= 1)?1:$page;

			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['exam']= $this->query_sql
			->view('*',"exam",($page-1)*$config['per_page'],$config['per_page']);
		}
		$data['template']='backend/exam/index';
		$this->load->view('backend/layout/admin',$data);
	}
	public function add()
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['exam'] = $this->query_sql
			->select_array("exam","*","","","");			
		$data['title'] = 'Manage Add exam';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('info','Info', 'required');
				$this->form_validation->set_rules('time','Time','required');
				//$this->form_validation->set_rules('url','URL','required');
				if($this->form_validation->run()){
					$data = array(
							'info' => $this->input->post('info'), 
							'name' => $this->input->post('name'), 
							'time' => $this->input->post('time'),
							'url'  => $this->input->post('url'),
							'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
									);
				$flag = $this->query_sql->add('exam',$data);				
				$this->session->set_flashdata('noice',1);				
				redirect('admin/exam/index');
				}
				
			}
		// end check
		$data['template']='backend/exam/add';
		$this->load->view('backend/layout/admin',$data);
		
	}
	public function update($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Update exam';	
		$data['exam']= $this->query_sql->select_row('exam','id,name, info, time, url, updated',array('id'=>$id),'');
		if($this->input->post()){
			$this->form_validation->set_rules('info','Info', 'required|min_length[6]');
				$this->form_validation->set_rules('time','Time','required');
				$this->form_validation->set_rules('url','URL','required|valid_url');
				if($this->form_validation->run()){
		$data = array(
				'info' => $this->input->post('info'), 
				'name' => $this->input->post('name'), 
				'time' => $this->input->post('time'),
				'url'  => $this->input->post('url'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
		$flag = $this->query_sql->edit('exam',$data,array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',2);
				redirect('admin/exam/index');
			}
		}
		$data['template']='backend/exam/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$this->query_sql->del('exam',array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',3);
				redirect('admin/exam/index');
	}

		public function check_login ()
	{
		if($this->session->has_userdata('username'))
			return true;
		else return false;
	}

}

/* End of file Content_exam.php */
/* Location: ./application/controllers/admin/Content_exam.php */