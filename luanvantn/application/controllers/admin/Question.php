<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}


	public function index($page = 1)
	{
		$data['title'] = 'Manager Question';
		$data['error'] = $this->session->flashdata('noice');
		//pagination
		$this->load->library('pagination');
		$config = $this->query_sql->_pagination();
		$config['base_url'] = base_url().'admin/question/index/';
		$config['total_rows'] = $this->query_sql->total('question');
		$config['uri_segment'] = 4;
		$total_page = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $total_page)?$total_page:$page;
		$page = (!isset($page) | $page <= 1)?1:$page;
		$this->pagination->initialize($config);
		$data['list_pagination'] = $this->pagination->create_links();
		$data['question']= $this->query_sql
		->view('id, content, image, audio, level, created,id_long_question',"question",($page-1)*$config['per_page'],$config['per_page'] );
		//end pagination
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['question'] = $this->query_sql
			->select_array("question","id, content, image, audio, level, created","","",array("content" =>"$search"));		
		}
		
		$data['template']='backend/question/index';

		$this->load->view('backend/layout/admin_index',$data);
	}


	public function add()
	{
		$data['title'] = 'Manager Add Question';
		$data['group']= $this->query_sql->select_array('group','id, name','','','');
		$data['error'] = $this->session->flashdata('error');

		$data ['long_question'] = $this->query_sql
				->select_array ("long_question","id,long_content","","","");
		// print_r($data['long_question']);
		// die;

		if($this->input->post())
		{

			if($this->add_check_validation())
			{	
				$img = $_FILES["image"]["name"];
				$audio = $_FILES["audio_file"]["name"];

				if( $img && $audio)
				{
					$img_data = $this->add_img();
					$type_img = array("jpg","png","jpeg","gif");
					if(!in_array($img_data['image_type'],$type_img))
					{
						$this->session->set_flashdata('error', "The filetype of image you are attempting to upload is not allowed."); 
						redirect('admin/question/add');
					}
					
					if($img_data['file_size']>5120)
					{
						$this->session->set_flashdata('error', "The sizemax of image you are attempting to upload is not allowed."); 
						redirect('admin/question/add');
					}
					////////////////////////////////////
					$audio_data = $this->add_audio();
					$type_audio = array(".mp3",".MP3");
					if(!in_array($audio_data['file_ext'],$type_audio))
					{
						$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
						redirect('admin/question/add');
					}
					$question_id = $this->add_question($img_data['file_name'],$audio_data['file_name']);
					
				}	
				else
				{
					if($img )
					{
						$img_data = $this->add_img();
						//check error upload image
						$type_img = array("jpg","png","jpeg","gif");
						if(!in_array($img_data['image_type'],$type_img))
						{
							$this->session->set_flashdata('error', "The filetype of image you are attempting to upload is not allowed."); 
							redirect('admin/question/add');
						}
							
						if($img_data['file_size'] >5120)
						{
							$this->session->set_flashdata('error', "The sizemax of image you are attempting to upload is not allowed."); 
							redirect('admin/question/add');
						}
						$question_id = $this->add_question($img_data['file_name'],"");
						//////////////////////////////////////
					}
					else if($audio)
					{					
						$audio_data = $this->add_audio();
						$type_audio = array(".mp3",".MP3");
						if(!in_array($audio_data['file_ext'],$type_audio))
						{
							$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
							redirect('admin/question/add');
						}
						$question_id = $this->add_question("",$audio_data['file_name']);
					}
					else $question_id = $this->add_question();
				}
				
				for ($i=1; $i<=$this->input->post('numberchoose');$i++)
				{	
					$choosevalue = $this->input->post("choosecorrect");
					if($choosevalue==$i)
					{
						$this->add_chosese($question_id['id'],$i,1);
					}
					else $this->add_chosese($question_id['id'],$i,0);
				}
				$this->session->set_flashdata('noice',1);	

				redirect('admin/question/index');
			}
			$data['error'] = validation_errors();

			 
		}
		$data['template']='backend/question/add';
		$data['my_js']='backend/element/foot/my_js/add_edit_question_js';
		$this->load->view('backend/layout/admin',$data);
	}


	public function update($id)
	{
		$data['title'] = 'Manager Update Question';
		
		$data['group']= $this->query_sql->select_array('group','id, name','','','');
		
		$data['question'] = $this->query_sql
		->select_row('question','id,content,image,audio,level,group_id,id_long_question',array('id' => $id),'');
		
		$data['chooses']= $this->query_sql
		->select_array('choice','id,content,correct_answer',array('question_id' => $id),'','');
		
				$data ['long_question'] = $this->query_sql
				->select_array ("long_question","id,long_content","","","");
				$this->form_validation->set_rules('long_question','Long question','required'); 			

		if($this->add_check_validation())
		{
				
			if($this->input->post())
			{
				/*
					#add question if exist file img and audio update content audio name and image name
					#unlink file if user upload file, that file existed
				*/
					$img = $_FILES["image"]["name"];
					$audio = $_FILES["audio_file"]["name"];
					if( $img && $audio)
					{
						$img_data = $this->add_img();
						$type_img = array("jpg","png","jpeg","gif");
						if(!in_array($img_data['image_type'],$type_img))
						{
							$this->session->set_flashdata('error', "The filetype of image you are attempting to upload is not allowed."); 
							redirect("admin/question/update/$id");
						}
						
						if($img_data['file_size']>5120)
						{
							$this->session->set_flashdata('error', "The sizemax of image you are attempting to upload is not allowed."); 
							redirect("admin/question/update/$id");
						}
						////////////////////////////////////
						$audio_data = $this->add_audio();
						$type_audio = array(".mp3",".MP3");
						if(!in_array($audio_data['file_ext'],$type_audio))
						{
							$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
							redirect("admin/question/update/$id");
						}


						//unlink
						if($data['question']['image']!="" && $data['question']['audio']!="")
						{
							$unlink_img = "uploads/listen_photo/".$data['question']['image'];
							unlink($unlink_img);
							$unlink_audio = "uploads/audio_files/".$data['question']['audio'];		
							unlink($unlink_audio);
						}
						else
						{

							if($data['question']['image']!="" ) 
							{
								$unlink_img = "uploads/listen_photo/".$data['question']['image'];
								unlink($unlink_img);
							}
							else
							{
								$unlink_audio = "uploads/audio_files/".$data['question']['audio'];	
								unlink($unlink_audio);
							}
						}
						//update
						$question_id = $this->update_question($img_data['file_name'],$audio_data['file_name'],$id);
						
					}	
					else
					{
						if($img )
						{
							$img_data = $this->add_img();

							$type_img = array("jpg","png","jpeg","gif");
							if(!in_array($img_data['image_type'],$type_img))
							{
								$this->session->set_flashdata('error', "The filetype of image you are attempting to upload is not allowed."); 
								redirect("admin/question/update/$id");
							}
							
							if($img_data['file_size']>5120)
							{
								$this->session->set_flashdata('error', "The sizemax of image you are attempting to upload is not allowed."); 
								redirect("admin/question/update/$id");
							}

							//unlink
							if($data['question']['image']!="") 
							{
								$unlink_img = "uploads/listen_photo/".$data['question']['image'];
								unlink($unlink_img);
							}
							//update
							$question_id = $this->update_question($img_data['file_name'],"",$id);
						}
						if($audio)
						{	
							$audio_data = $this->add_audio();
							$type_audio = array(".mp3",".MP3");
							if(!in_array($audio_data['file_ext'],$type_audio))
							{
								$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
								redirect("admin/question/update/$id");
							}
							if($data['question']['audio']!="") 
							{
								$unlink_audio = "uploads/audio_files/".$data['question']['audio'];	
								unlink($unlink_audio);
							}
							$question_id = $this->update_question("",$audio_data['file_name'],$id);
						}
						else
						{
							$long_question = $this->input->post('long_question');
							if($long_question != '-1')
							{
								$update_data = array(	
									'content'  => $this->input->post('content'),
									'level'	   => $this->input->post('level'),
									'group_id' => $this->input->post('group'),
									'id_long_question' =>$long_question,
									'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
									);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));

							}
							else
							{
								$long_question = NULL;
								$update_data = array(	
								'content'  => $this->input->post('content'),
								'level'	   => $this->input->post('level'),
								'group_id' => $this->input->post('group'),
								'id_long_question' =>$long_question,
								'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
								);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));
							}
						}				
					} //end add question

					for ($i=1; $i<=4;$i++)
					{		
						$choosevalue = $this->input->post("choosecorrect");
						if($choosevalue==$i)
						{
							$this->update_chosese($data['chooses'][$i-1]['id'],$i,1);
						}
						else $this->update_chosese($data['chooses'][$i-1]['id'],$i,0);
					}
					$this->session->set_flashdata('noice',2);	

				redirect('admin/question/index');
			}
		}
		$data['template']='backend/question/edit';
		$data['my_js']='backend/element/foot/my_js/add_edit_question_js';

		$this->load->view('backend/layout/admin',$data);
	}


	public function delete($id)
	{
		$data['question'] = $this->query_sql
		->select_row('question','id,content,image,audio ',array('id' => $id),'');
		$data['chooses']= $this->query_sql
		->select_array('choice','id',array('question_id' => $id),'','');
		foreach($data['chooses'] as $a)
		{
			$this->query_sql->del('choice',array('id' => $a['id']));
		}
		$this->query_sql->del('question',array('id' => $id));
		$img = "uploads/listen_photo/".$data['question']['image'];
		unlink($img);
		$audio = "uploads/audio_files/".$data['question']['audio'];		
		unlink($audio);
		$this->query_sql->del('question',array('id' => $id));
		$this->session->set_flashdata('noice',3);
				redirect('admin/question/index');
	}

	//--------------------------------------------------
	/*
		# add question 

		@return max_id question
	*/
	private function add_question($img = "", $audio = "")
	{
		if($this->input->post('long_question') != "-1")
		{ 
			$long_question = $this->input->post('long_question');
			$question = array(
			'id'	   =>'',	
			'content'  => $this->input->post('content'),
			'image'    => $img,
			'audio'    => $audio,
			'level'	   => $this->input->post('level'),
			'id_long_question' => $long_question,
			'group_id' => $this->input->post('group'),
			'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->add('question',$question);			
			return $result['id'];
		}
		else
		{
		$question = array(
			'id'	   =>'',	
			'content'  => $this->input->post('content'),
			'image'    => $img,
			'audio'    => $audio,
			'level'	   => $this->input->post('level'),
			'group_id' => $this->input->post('group'),
			'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->add('question',$question);			
			return $result['id'];
		}
	}
	// private function add_long_question()
	// {
	// 	$long_question = array(
	// 		'id'	   =>'',	
	// 		'long_content'  => $this->input->post('long_question'),
	// 			);
	// 		$result = $this->query_sql->add('long_question',$long_question);			
	// 		return $result['id'];
	// }
	// private function update_long_question($img = "", $audio = "",$id)
	// {
	// 	$long_question = array(
	// 		'long_content'  => $this->input->post('long_question')			
	// 			);
	// 		$result = $this->query_sql->edit('question',$long_question,array('id'=>$id));			
	// 		return $result;
	// }
	private function update_question($img = "", $audio = "",$id)
	{
		$long_question = $this->input->post("long_question");		
		if($this->input->post("long_question")!='-1')
		{
			
			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
					);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;
		}
		else
		{
			$long_question = NULL;
			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
					);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;
		}
	}


	/*
		#check validattion for add question
		#check required,trim for content question
		#check required for choosecorrect choose
		#check required,trim for content choose A,B,C,D

		@return form_validation->run() = true or false
	*/
	private function add_check_validation()
	{
		$this->form_validation->set_rules('content','Question','trim|required');
		$this->form_validation->set_rules('level','Level','required|numeric|max_length[3]');
		$this->form_validation->set_rules('choosecorrect','Correct answer','required');
		$this->form_validation->set_rules('choosecontent1','Choose A','trim|required');
		$this->form_validation->set_rules('choosecontent2','Choose B','trim|required');
		$this->form_validation->set_rules('choosecontent3','Choose C','trim|required');


		if($this->input->post("numberchoose") == 4)
		{
		$this->form_validation->set_rules('choosecontent4','Choose D','trim|required');
		}
		return $this->form_validation->run();
	}
	/*
		#create_dir a dir for image file go to uploads/listen_photo/
		#if not exist create_dir is created_dir with link uploads/listen_photo/
		#confif for type 'jpg|png|jpeg|gif' and  max_size

		@return file name of image
	*/
	private function add_img()
	{
			$album_dir = './uploads/listen_photo/';
			if(!is_dir($album_dir)){ create_dir($album_dir); } 
			$config['upload_path']	= $album_dir;
			$config['allowed_types'] = 'jpg|png|jpeg|gif'; 
			$config['max_size'] = 5120;

			$this->load->library('upload', $config); 
			$this->upload->initialize($config); 
			$image = $this->upload->do_upload("image");
			$image_data = $this->upload->data();
			return $image_data;
	}
	/*
		#create_dir a dir for audio file go to uploads/listen_photo/
		#if not exist create_dir is created_dir with link uploads/listen_photo/
		#confif for type 'jpg|png|jpeg|gif' and  max_size

		@return file name of audio

	*/
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
	/*
		# add choose of question with 
		# $question_id is id of question
		# $value is value of name for input choosecontent$value
		# $choose_corect input 1 or 0 to input correct_answer in DB

		@return data array of choose
	*/
	private function add_chosese($question_id,$value,$correct_answer)
	{
		//$value = $this->input->post("choosecontent$value");
		$chosese = array(
			'id'	   			=>'',	
			'content'  			=> $this->input->post("choosecontent$value"), 
			'question_id' 		=> $question_id,
			'correct_answer'	=>$correct_answer,
			'created'  			=> gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->add('choice',$chosese);
			return $result;
	}
	
	private function update_chosese($choose_id,$value,$correct_answer)
	{
		$chosese = array(
			'content'  			=> $this->input->post("choosecontent$value"),
			'correct_answer'	=>$correct_answer,
			'updated'  			=> gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->edit('choice',$chosese,array('id'=>$choose_id));
			return $result;
	}

}

/* End of file Question.php */
/* Location: ./application/controllers/admin/Question.php */