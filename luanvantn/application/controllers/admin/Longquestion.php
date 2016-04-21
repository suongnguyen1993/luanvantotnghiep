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
		$data['group']= $this->query_sql->select_array('group','id, name','','','');
		$data['long_question'] = $this->query_sql
			->select_array("long_question","id,long_content,long_audio,group_id,exam_id","","","");
		$data ['exam'] = $this->query_sql
			->select_array ("exam","id,name","","","");
		$data['title'] = 'Manage Add Long Question';
		$data['error'] = $this->session->flashdata('error');
		// check form_validation
			if($this->input->post()){
				$this->form_validation->set_rules('long_content','Long question', 'required');
				if($this->form_validation->run())
				{

					$exam = $this->input->post('exam');
					$audio = $_FILES["audio_file"]["name"];

					//nếu có audio
					if($audio)
					{ 
						$audio_data = $this->add_audio();
						$type_audio = array(".mp3",".MP3");
						if(!in_array($audio_data['file_ext'],$type_audio))
						{
							$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
							redirect("admin/exam/add");
						}
						else
						{
							if($exam != '-1')
							{					
								$data = array(
									'id' 			=> '',
									'long_content' 	=> $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),
									'long_audio' => $audio_data['file_name'],			
									'exam_id'		=> $exam
									);
								$flag = $this->query_sql->add('long_question',isset($data)?$data:"");
											
								$this->session->set_flashdata('noice',1);	
								redirect('admin/longquestion/index');
							}
							else
							{ 	$exam = NULL;
								$data = array(
									'id' 			=> '',
									'long_content' 	=> $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),			
									'long_audio' => $audio_data['file_name'],			
									'exam_id'		=> $exam
									);
								$flag = $this->query_sql->add('long_question',isset($data)?$data:"");
											
								$this->session->set_flashdata('noice',1);	
								redirect('admin/longquestion/index');
							}
						}
					}
					//không có audio
					else 
					{
						if($exam != '-1')
						{					
							$data = array(
								'id' 			=> '',
								'long_content' 	=> $this->input->post('long_content'),
								'group_id' 	=> $this->input->post('group'),			
								'exam_id'		=> $exam
								);
							$flag = $this->query_sql->add('long_question',isset($data)?$data:"");										
							$this->session->set_flashdata('noice',1);	
							redirect('admin/longquestion/index');
						}
						else
						{ 	$exam = NULL;
							$data = array(
								'id' 			=> '',
								'long_content' 	=> $this->input->post('long_content'),
								'group_id' 	=> $this->input->post('group'),			
								'exam_id'		=> $exam
								);
							$flag = $this->query_sql->add('long_question',isset($data)?$data:"");
										
							$this->session->set_flashdata('noice',1);	
							redirect('admin/longquestion/index');
						}
					}
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
		$data['group']= $this->query_sql->select_array('group','id, name','','','');
		$data['title'] = 'Manage Update Long Question';	
		$data['long_question']= $this->query_sql->select_row('long_question','long_content,long_audio, exam_id,group_id',array('id'=>$id),'');
		$data['question'] = $this->query_sql->select_array('question','id, content,',array('id_long_question'=>$id),'', "");
		$data ['exam'] = $this->query_sql
			->select_array ("exam","id,name","","","");

		
		if($this->input->post()){
			$this->form_validation->set_rules('long_content','Long question', 'required');			
			if($this->form_validation->run())
			{
				$exam = $this->input->post('exam');
				$audio = $_FILES["audio_file"]["name"];
					//nếu có audio
					if($audio)
					{
						$audio_data = $this->add_audio();
						$type_audio = array(".mp3",".MP3");
						if(!in_array($audio_data['file_ext'],$type_audio))
						{
							$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
							redirect("admin/exam/add");
						}
						else
						{
							if($data['long_question']['long_audio']!="")
							{
								$unlink_audio = "uploads/audio_files/".$data['long_question']['long_audio'];	
								unlink($unlink_audio);
							}
							if($exam != '-1')
							{					
								$data = array(
									'id' 			=> '',
									'long_content' 	=> $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),
									'long_audio' => $audio_data['file_name'],			
									'exam_id'		=> $exam
									);
								$flag = $this->query_sql->edit('long_question',$data,array('id' => $id));
								$this->session->set_flashdata('noice',2);
									redirect('admin/longquestion/index');
							}
							else
							{ 	$exam = NULL;
								$data = array(
									'id' 			=> '',
									'long_content' 	=> $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),			
									'long_audio' => $audio_data['file_name'],			
									'exam_id'		=> $exam
									);
								$flag = $this->query_sql->edit('long_question',$data,array('id' => $id));
								$this->session->set_flashdata('noice',2);
									redirect('admin/longquestion/index');
							}
						}
					}
					//khong co audio
					else
					{
						if($exam != '-1')
						{
							$data = array(
									'long_content' => $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),			
									'exam_id' => $exam
									);
							$flag = $this->query_sql->edit('long_question',$data,array('id' => $id));
							$this->session->set_flashdata('noice',2);
							redirect('admin/longquestion/index');
						}
						else
						{
							$exam = NULL;
							$data = array(
									'long_content' => $this->input->post('long_content'),
									'group_id' 	=> $this->input->post('group'),			
									'exam_id' => $exam
									);
							$flag = $this->query_sql->edit('long_question',$data,array('id' => $id));
							$this->session->set_flashdata('noice',2);
							redirect('admin/longquestion/index');
						}
					}

				/**/
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
		$data['long_question']= $this->query_sql->select_row('long_question','long_content,long_audio, exam_id,group_id',array('id'=>$id),'');
		foreach($data['question'] as $q)
		{	
			$data['chooses']= $this->query_sql
			->select_array('choice','id',array('question_id' => $q['id']),'','');
			print_r($data['chooses']);
			//delete question cua long_question
			foreach($data['chooses'] as $a)
			{			
				$this->query_sql->del('choice',array('id' => $a['id']));								
			}

			$this->query_sql->del('question',array('id' => $q['id']));
			//unlink hinh hoac audio cua quesiton
			if($q['image'] != "" || $q['audio'] !="")
			{
			$img = "uploads/listen_photo/".$q['image'];
			unlink($img);
			$audio = "uploads/audio_files/".$q['audio'];		
			unlink($audio);
			}

		}
		//xoa long_question 
		$this->query_sql->del('long_question',array('id' => $id));
		//unlink audio long question.
		if($data['long_question']['long_audio'] != "")
		{
			$audio = "uploads/audio_files/".$data['long_question']['long_audio'];		
			unlink($audio);
		}

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
	private function add_audio()
	{
			$album_dir = './uploads/audio_files/';
			if(!is_dir($album_dir)){ create_dir($album_dir); } 
			$config['upload_path']	= $album_dir;
			$config['allowed_types'] = 'mp3|MP3';

			$this->load->library('upload', $config); 
			$this->upload->initialize($config); 
			$audio = $this->upload->do_upload("audio_file");
			$audio_data =$this->upload->data();
			return $audio_data;
	}

}

/* End of file long_question.php */
/* Location: ./application/controllers/admin/long_question.php */