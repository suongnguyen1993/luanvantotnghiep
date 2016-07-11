<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

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
		$data['title'] = 'Manage Exam';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['exam'] = $this->query_sql
			->select_array("exam","*","","",array("name" =>"$search"));
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
			if($this->input->post())
			{
				$this->form_validation->set_rules('name','Name', 'required');
				$this->form_validation->set_rules('info','Info', 'required');
				$this->form_validation->set_rules('time','Time','required|exact_length[4]|numeric|callback_check_valid_time');

				if($this->form_validation->run())
				{	
					$audio = $_FILES["audio_file"]["name"];
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
							$data = array(
							'id' => "",
							'info' => $this->input->post('info'), 
							'name' => $this->input->post('name'), 
							'time' => $this->input->post('time'),
							'audio' => $audio_data['file_name'],
							'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
									);
							$flag = $this->query_sql->add('exam',$data);
							
							$this->session->set_flashdata('flag', $flag);
							$this->session->set_flashdata('noice',1);
							redirect('admin/exam/index');
						}
					}	
					else 
					{
						$data = array(
							'id' => "",
							'info' => $this->input->post('info'), 
							'name' => $this->input->post('name'), 
							'time' => $this->input->post('time'),
							'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
									);
							$flag = $this->query_sql->add('exam',$data);
							
							$this->session->set_flashdata('flag', $flag);
							$this->session->set_flashdata('noice',1);
							redirect('admin/exam/index');
					}
													
				}
				
			}
		// end check
		$data['my_js']='backend/element/foot/my_js/add_edit_question_js';
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
		$data['exam']= $this->query_sql->select_row('exam','id,name, info, time, audio, updated',array('id'=>$id),'');
		if($this->input->post())
		{
			$this->form_validation->set_rules('info','Info', 'required');
			$this->form_validation->set_rules('time','Time','required|exact_length[4]|numeric|callback_check_valid_time');

			if($this->form_validation->run())
			{
				$audio = $_FILES["audio_file"]["name"];
				if($audio != "")
				{
					$audio_data = $this->add_audio();
					$type_audio = array(".mp3",".MP3");
					if(!in_array($audio_data['file_ext'],$type_audio))
					{
						$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
						redirect("admin/exam/update/$id");
					}
					else
					{
						if($data['exam']['audio']!="")
							{
								$unlink_audio = "uploads/audio_files/".$data['exam']['audio'];	
								unlink($unlink_audio);
							}
						$data = array(
						'info' => $this->input->post('info'), 
						'name' => $this->input->post('name'), 
						'time' => $this->input->post('time'),
						'audio' => $audio_data['file_name'],
						'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
								);
						$flag = $this->query_sql->edit('exam',$data,array('id' => $id));
						$this->session->set_flashdata('flag', $flag);
						$this->session->set_flashdata('noice',2);
						redirect('admin/exam/index');
					}
				}
				else
				{
					$data = array(
					'info' => $this->input->post('info'), 
					'name' => $this->input->post('name'), 
					'time' => $this->input->post('time'),
					'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)		
							);
					$flag = $this->query_sql->edit('exam',$data,array('id' => $id));
					$this->session->set_flashdata('flag', $flag);
					$this->session->set_flashdata('noice',2);
					redirect('admin/exam/index');
				}
			}
		}
		$data['my_js']='backend/element/foot/my_js/add_edit_question_js';
		$data['template']='backend/exam/edit';
		$this->load->view('backend/layout/admin',$data);
	}
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['exam'] = $this->query_sql->select_row('exam','id,name, info, time, audio, updated',array('id'=>$id),'');
		$countquestion = $this->query_sql->total_where('question',array('exam_id'=>$id));
		if($countquestion != 0 )
		{
			$this->session->set_flashdata('noice',4);
			redirect('admin/exam/index');
		}
		else
		{
			$this->query_sql->del('exam',array('id' => $id));
			$audio = "uploads/test_audio/".$data['exam']['audio'];		
			unlink($audio);
			$this->session->set_flashdata('flag', $flag);
			$this->session->set_flashdata('noice',3);
			redirect('admin/exam/index');
		}
	}

		public function check_login ()
	{
		if($this->session->has_userdata('admin'))
			return true;
		else return false;
	}

	private function add_audio()
	{
			$album_dir = './uploads/test_audio/';
			if(!is_dir($album_dir)){ create_dir($album_dir); } 
			$config['upload_path']	= $album_dir;
			$config['allowed_types'] = 'mp3|MP3';

			$this->load->library('upload', $config); 
			$this->upload->initialize($config); 
			$audio = $this->upload->do_upload("audio_file");
			$audio_data =$this->upload->data();
			return $audio_data;
	}
	public function check_valid_time()
	{

	    $time = $this->input->post('time',TRUE);
		if($time <= date("Y"))
		{
			return true;
		}
		else 
		{

			$this->form_validation->set_message('check_valid_time', 'The %s field is invalid');
			return false;
		}    
	}					

}

/* End of file exam.php */
/* Location: ./application/controllers/admin/exam.php */