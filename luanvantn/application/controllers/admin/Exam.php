<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		$data['title'] = 'Manage Exam';
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
		$data['exam'] = $this->query_sql
			->select_array("exam","*","","","");
			
		

		$data['title'] = 'Manage Add exam';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('info','Info', 'required|min_length[6]');
				$this->form_validation->set_rules('time','Time','required');
				$this->form_validation->set_rules('url','URL','required|valid_url');
				if($this->form_validation->run()){
					$data = array(
							'info' => $this->input->post('info'), 
							'time' => $this->input->post('time'),
							'url'  => $this->input->post('url'),
							'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
									);
				$flag = $this->query_sql->add('exam',$data);				
				$this->session->set_flashdata('noice',
				 '<div class="alert alert-success alert-dismissable text-center" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Add success!</strong>
				</div>');				
				redirect('admin/exam/index');
				}
				
			}
		// end check
		$data['template']='backend/exam/add';
		$this->load->view('backend/layout/admin',$data);
		
	}
	public function update($id)
	{
		$data['title'] = 'Manage Update exam';	
		$data['exam']= $this->query_sql->select_row('exam','id, info, time, url, updated',array('id'=>$id),'');
		if($this->input->post()){
			$this->form_validation->set_rules('info','Info', 'required|min_length[6]');
				$this->form_validation->set_rules('time','Time','required');
				$this->form_validation->set_rules('url','URL','required|valid_url');
				if($this->form_validation->run()){
		$data = array(
				'info' => $this->input->post('info'), 
				'time' => $this->input->post('time'),
				'url'  => $this->input->post('url'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
						);
		$flag = $this->query_sql->edit('exam',$data,array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',
				 '<div class="alert alert-success alert-dismissable text-center" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Updated success!</strong>
				</div>');
				redirect('admin/exam/index');
			}
		}
		$data['template']='backend/exam/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		$this->query_sql->del('exam',array('id' => $id));
		$this->session->set_flashdata('flag', $flag);
		$this->session->set_flashdata('noice',
				 '<div class="alert alert-success alert-dismissable text-center" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Deleted success!</strong>
				</div>');
				redirect('admin/exam/index');
	}

	public function Ajax()
	{
		echo 'hello';
	}

}

/* End of file exam.php */
/* Location: ./application/controllers/admin/exam.php */