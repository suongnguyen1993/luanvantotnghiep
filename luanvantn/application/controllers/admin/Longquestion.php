<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Longquestion extends CI_Controller {

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
		$data['title'] = 'Manage Long Question';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['long_question'] = $this->query_sql
			->select_array("long_question","*","","",array("long_content" =>"$search"));
		}
		else
		{
			
			$this->load->library('pagination');
			$config = $this->query_sql->_pagination();
			$config['base_url'] = base_url().'admin/long_question/index/';
			$config['total_rows'] = $this->query_sql->total('long_question');
			$config['uri_segment'] = 4;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$page = ($page > $total_page)?$total_page:$page;
			$page = (!isset($page) | $page <= 1)?1:$page;

			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['long_question']= $this->query_sql
			->view('*',"long_question",($page-1)*$config['per_page'],$config['per_page']);
		}
		$data['template']='backend/longquestion/index';
		$this->load->view('backend/layout/admin',isset($data)?$data:"");
	}
	public function add()
	{	
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['long_question'] = $this->query_sql
			->select_array("long_question","id,long_content","","","");
		$data['title'] = 'Manage Add Long Question';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('long_content','Long question', 'required');
				if($this->form_validation->run()){
					
					$data = array(
						'id' => '',
						'long_content' => $this->input->post('long_content')								
						);
				$flag = $this->query_sql->add('long_question',isset($data)?$data:"");				
				$this->session->set_flashdata('noice',1);	
				redirect('admin/longquestion/index');
				}
				
			}
		// end check
		$data['template']='backend/longquestion/add';
		$data['my_js']='backend/element/foot/my_js/ckeditor';
		$this->load->view('backend/layout/admin',isset($data)?$data:"");
		
	}
	public function update($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Update Long Question';	
		$data['long_question']= $this->query_sql->select_row('long_question','long_content',array('id'=>$id),'');
		$data['question'] = $this->query_sql->select_array('question','id, content,',array('id_long_question'=>$id),'', "");
		
		if($this->input->post()){
			$this->form_validation->set_rules('long_content','Long question', 'required');			
			if($this->form_validation->run()){
				$data = array(
						'long_content' => $this->input->post('long_content') 
							
								);
				$flag = $this->query_sql->edit('long_question',$data,array('id' => $id));
				$this->session->set_flashdata('noice',2
							 );
						redirect('admin/longquestion/index');
					}
		}
		$data['template']='backend/longquestion/edit';
		$data['my_js']='backend/element/foot/my_js/ckeditor';
		$this->load->view('backend/layout/admin',isset($data)?$data:"");
	}
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['question'] = $this->query_sql->select_array('question','id, content,image,audio',array('id_long_question'=>$id),'', "");
		foreach($data['question'] as $q)
		{	
			$data['chooses']= $this->query_sql
			->select_array('choice','id',array('question_id' => $q['id']),'','');
			print_r($data['chooses']);
			
			foreach($data['chooses'] as $a)
			{			
				$this->query_sql->del('choice',array('id' => $a['id']));								
			}

			$this->query_sql->del('question',array('id' => $q['id']));
			if($q['image'] != "" || $q['audio'] !="")
			{
			$img = "uploads/listen_photo/".$q['image'];
			unlink($img);
			$audio = "uploads/audio_files/".$q['audio'];		
			unlink($audio);
			}

		}

		$this->query_sql->del('long_question',array('id' => $id));

		$this->session->set_flashdata('noice',3
				 );
	
				redirect('admin/longquestion/index');

	}
	public function check_login ()
	{
		if($this->session->has_userdata('username'))
			return true;
		else return false;
	}

}

/* End of file long_question.php */
/* Location: ./application/controllers/admin/long_question.php */