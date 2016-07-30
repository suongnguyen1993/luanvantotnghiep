<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

/*
	-Hàm index hiển thị dữ liệu của Amin 
	# if check_login() = false thì chuyển về trang admin/login
	# $page = 1 là biến dùng phân trang
	# if check_login() == false thì quay lại trang login
	# phân trang (mỗi trang gồm 10 phần từ) hiển thị dữ liệu của question vào $data['question']
	# $search là dữ liệu lấy từ from search
	# if $this->input->post() có dữa liệu đưa lên qua form thì gán dữ liệu được tìm kiếm thông qua search vào $data['question'] xuất dữ liệu tìm kiếm

	@return dữ liệu question hoặc dữ liệu tim kiếm question
*/

	public function index($page = 1)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
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

		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['question'] = $this->query_sql
			->select_array("question","id, content, image, audio, level, created","","",array("content" =>"$search"));		
		}

		$data['template']='backend/question/index';

		$this->load->view('backend/layout/admin_index',isset($data)?$data:"");
	}


	public function add($id_exam = NULL)
	{
	//check check_login()
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		if($id_exam != NULL)
		{
			$data['id_exam'] = $id_exam;
		}

		$data['title'] = 'Manager Add Question';
		$data['group']= $this->query_sql->select_array('group','id, name','','','');
		$data['error'] = $this->session->flashdata('error');

		$data ['long_question'] = $this->query_sql
		->select_array ("long_question","id,long_content","","","");

		$data ['exam'] = $this->query_sql
		->select_array ("exam","id,name","","","");

		if($this->input->post())
		{ 

			if($this->add_check_validation())
			{	
				$img = $_FILES["image"]["name"];
				$audio = $_FILES["audio_file"]["name"];
			// có cả 2 file hình và file audio
				if( $img && $audio)
				{
				/*
						# giá trị $img là tên file hình lấy từ form
						# giá trị $ audio là tên fiel audio lấy từ form
						
						# $img_data là giá trị lưu khi gọi hàm add_img() chứa thông tin file hình
						# $type_img mảng đuôi của file hình
						# if $img_data['image_type'] là phần mở rộng của file hình (vd:.jpg) không thuộc trong mảng $type_img thì lưu set_flashdata và quay về trang admin/question/add
						# $img_data['file_size'] kích thước ảnh
						# if $img_data['file_size'] > 5120 (khoảng 5M) thì lưu set_flashdata và quay về trang admin/question/add

						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin audio
						# $type_audio mảng đuôi của file hình
						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin file hình
						# $type_audio mảng đuôi của file hình
						# if $audio_data['file_ext'] là phần mở rộng của file hình (vd:png) không thuộc trong mảng $type_audio thì lưu set_flashdata và quay về trang admin/question/add

						@ return thêm 1 dòng dữ liệu  vào bang question có file hình và file audio 

						
					*/
						$img_data = $this->add_img();
						$type_img = array("jpg","png","jpeg","gif");
						if(!in_array($img_data['image_type'],$type_img))
						{
							$this->session->set_flashdata('error', "The filetype of image you are attempting to upload is not allowed."); 
							redirect('admin/question/add');
						}

						else if($img_data['file_size']>5120)
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
			//nếu không có cả 2 file hình và file audio
					else
					{
						if($img )
						{
					/*
						# $img_data là giá trị lưu khi gọi hàm add_img() chứa thông tin file hình
						# $type_img mảng đuôi của file hình
						# if $img_data['image_type'] là phần mở rộng của file hình (vd:.jpg) không thuộc trong mảng $type_img thì lưu set_flashdata và quay về trang admin/question/add
						# $img_data['file_size'] kích thước ảnh
						# if $img_data['file_size'] > 5120 (khoảng 5M) thì lưu set_flashdata và quay về trang admin/question/add
						if có tên hinh trong dữ liệu question thì xóa hình ra khỏi thư mục uploads/listen_photo/".

						@return thêm 1 dòng vào bảng question có tên hình
					*/

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

					}

				// có file audio
					else if($audio)
					{	
					/*
						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin audio
						# $type_audio mảng đuôi của file hình
						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin file hình
						# $type_audio mảng đuôi của file hình
						# if $audio_data['file_ext'] là phần mở rộng của file hình (vd:png) không thuộc trong mảng $type_audio thì lưu set_flashdata và quay về trang admin/question/add

						@return thêm 1 dòng vào bảng question có tên audio
					*/	
						$audio_data = $this->add_audio();
						$type_audio = array(".mp3",".MP3");
						if(!in_array($audio_data['file_ext'],$type_audio))
						{
							$this->session->set_flashdata('error', "The filetype of audio you are attempting to upload is not allowed."); 
							redirect('admin/question/add');
						}
						$question_id = $this->add_question("",$audio_data['file_name']);

					}
					else
					{ 
						$question_id = $this->add_question();

					}
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
		$this->load->view('backend/layout/admin',isset($data)?$data:"");
	}


	public function update($id)
	{
	//check login
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manager Update Question';

		$data['group']= $this->query_sql->select_array('group','id, name','','','');

		$data['question'] = $this->query_sql
		->select_row('question','id,content,image,audio,level,group_id,id_long_question,exam_id',array('id' => $id),'');

		$data ['exam'] = $this->query_sql
		->select_array ("exam","id,name","","","");

		$data['chooses']= $this->query_sql
		->select_array('choice','id,content,correct_answer',array('question_id' => $id),'','');

		$data ['long_question'] = $this->query_sql
		->select_array ("long_question","id,long_content","","","");
		$this->form_validation->set_rules('long_question','Long question','required'); 			

		if($this->add_check_validation())
		{
			
			if($this->input->post())
			{

				$img = $_FILES["image"]["name"];
				$audio = $_FILES["audio_file"]["name"];

				//nêu có file hình và audio
				if( $img && $audio)
				{
					/*
						# giá trị $img là tên file hình lấy từ form
						# giá trị $ audio là tên fiel audio lấy từ form
						
						# $img_data là giá trị lưu khi gọi hàm add_img() chứa thông tin file hình
						# $type_img mảng đuôi của file hình
						# if $img_data['image_type'] là phần mở rộng của file hình (vd:.jpg) không thuộc trong mảng $type_img thì lưu set_flashdata và quay về trang admin/question/update/$id
						# $img_data['file_size'] kích thước ảnh
						# if $img_data['file_size'] > 5120 (khoảng 5M) thì lưu set_flashdata và quay về trang admin/question/update/$id

						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin audio
						# $type_audio mảng đuôi của file hình
						# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin file hình
						# $type_audio mảng đuôi của file hình
						# if $audio_data['file_ext'] là phần mở rộng của file hình (vd:png) không thuộc trong mảng $type_audio thì lưu set_flashdata và quay về trang admin/question/update/$id

						#else if có tên hinh trong dữ liệu question thì xóa hình ra khỏi thư mục uploads/listen_photo/".
						# if if có tên audio trong dữ liệu question thì xóa audio ra khỏi thư mục uploads/audio_files/"

						@ return thêm cập nhật dữ liệu được sửa có file hình và file audio mới được cập nhật

						
					*/
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
				// không có cả 2 file hình và file câu audio cùng lúc
					else
					{
					//nếu cóa file hình 
						if($img )
						{
						/*
							# $img_data là giá trị lưu khi gọi hàm add_img() chứa thông tin file hình
							# $type_img mảng đuôi của file hình
							# if $img_data['image_type'] là phần mở rộng của file hình (vd:.jpg) không thuộc trong mảng $type_img thì lưu set_flashdata và quay về trang admin/question/update/$id
							# $img_data['file_size'] kích thước ảnh
							# if $img_data['file_size'] > 5120 (khoảng 5M) thì lưu set_flashdata và quay về trang admin/question/update/$id
							if có tên hinh trong dữ liệu question thì xóa hình ra khỏi thư mục uploads/listen_photo/".

							@return cập nhật lại thông tin của question có tên hình
						*/

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
					// có file audio
						if($audio)
						{	
						/*
							# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin audio
							# $type_audio mảng đuôi của file hình
							# $audio_data là giá trị lưu khi gọi hàm add_audio() chứa thông tin file hình
							# $type_audio mảng đuôi của file hình
							# if $audio_data['file_ext'] là phần mở rộng của file hình (vd:png) không thuộc trong mảng $type_audio thì lưu set_flashdata và quay về trang admin/question/update/$id

							@return cập nhật lại thông tin của question có tên file audio
						*/
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
					// không có cả 2 file hình và au audio
						else
						{
							$long_question = $this->input->post('long_question');
							$exam = $this->input->post('exam');
							if($long_question != '-1' && $exam != '-1')
							{
								$update_data = array(	
									'content'  => $this->input->post('content'),
									'level'	   => $this->input->post('level'),
									'group_id' => $this->input->post('group'),
									'id_long_question' =>$long_question,
									'exam_id' =>$exam,
									'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
									);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));

							}
							elseif($long_question != '-1')
							{
								$exam = NULL;
								$update_data = array(	
									'content'  => $this->input->post('content'),
									'level'	   => $this->input->post('level'),
									'group_id' => $this->input->post('group'),
									'id_long_question' =>$long_question,
									'exam_id' =>$exam,
									'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
									);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));

							}
							elseif($exam != '-1')
							{
								$long_question = NULL;
								$update_data = array(	
									'content'  => $this->input->post('content'),
									'level'	   => $this->input->post('level'),
									'group_id' => $this->input->post('group'),
									'id_long_question' =>$long_question,
									'exam_id' =>$exam,
									'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
									);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));

							}
							else
							{
								$long_question = NULL;
								$exam = NULL;
								$update_data = array(	
									'content'  => $this->input->post('content'),
									'level'	   => $this->input->post('level'),
									'group_id' => $this->input->post('group'),
									'id_long_question' =>$long_question,
									'exam_id' =>$exam,
									'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
									);	
								$question_id = $this->query_sql->edit('question',$update_data,array('id'=>$id));
							}
						}				
				} //end add question

				/*
					# giá trị $choosevalue là giá trị của choosecorrect.
					# if #choosecorrect = $i thì cho giá trị $correct_answer trong hàm update_chosese = 1
					#else thì cho giá trị $correct_answer trong hàm update_chosese = 0

				*/
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

		$this->load->view('backend/layout/admin',isset($data)?$data:"");
	}

/*
	-Hàm delete() xóa 1 question ra khỏi csdl

	# giá trị $id là id của question cần xóa.
	# $data['question'] dòng dữ liệu cần xóa.
	# $data['chooses'] dữ liệu choice của question
	# xóa tất cả các choice của question cần xóa.
	# xóa question
	# $img đường dẫn tới file hình của question.
	# $audio đường dẫn tới file audio của question.
	# xóa $img và $audio

	@return xuât thông báo và quay về trang admin/question/index
*/
	public function delete($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
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
	# thêm câu hỏi id, content, image, audio, level, id_long_question,group_id,created
	# giá trị $img tên file hình được lấy từ file
	# giá trị $audio tên file audio được lấy từ file
	# if giá trị long_question != -1 && giá trị exam != -1 thì thêm question có id_long_question và exam_id
	# else if giá trị long_question != -1 thì thêm question có giá trị id_long_question
	# else if giá trị exam_id != -1 thì thêm question có giá trị exam_id
	# else thì thêm question không có  id_long_question  và exam_id
	@return id của question vừa thêm vào
*/
	private function add_question($img = "", $audio = "")
	{

		if($this->input->post('long_question') != "-1" && $this->input->post('exam') != "-1")
		{ 
			$long_question = $this->input->post('long_question');
			$exam = $this->input->post('exam');
			$question = array(
				'id'	   =>'',	
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'exam_id' => $exam,
				'group_id' => $this->input->post('group'),
				'created'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->add('question',$question);			
			return $result['id'];
		}
		else if($this->input->post('long_question') != "-1")
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
		else if($this->input->post('exam') != "-1")
		{ 
			$exam = $this->input->post('exam');
			$question = array(
				'id'	   =>'',	
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'exam_id' => $exam,
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
/*
	-Hàm update_question()
	# cập nhật 1 question vào csdl 
	# giá trị $img tên file hình được lấy từ file
	# giá trị $audio tên file audio được lấy từ file
	# giá trị $id là id question cần sửa thông tin
	# if giá trị long_question != -1 && giá trị exam != -1 thì sửa question có id_long_question và exam_id
	# else if giá trị long_question != -1 thì sửa question có giá trị id_long_question
	# else if giá trị exam_id != -1 thì sửa question có giá trị exam_id
	# else thì sửa question không có  id_long_question  và exam_id

	@return kết quả question vừa được sửa
*/
	private function update_question($img = "", $audio = "",$id)
	{
		$long_question = $this->input->post("long_question");
		$exam = $this->input->post("exam");		
		if($this->input->post("long_question")!='-1' &&  $this->input->post("exam") != '-1' )
		{

			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'exam_id' => $exam,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;
		}
		elseif($this->input->post("long_question")!='-1')
		{
			$exam = NULL;
			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'exam_id' => $exam,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;
		}
		elseif($this->input->post("exam") != '-1' )
		{
			$long_question = NULL;
			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'exam_id' => $exam,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;		
		}
		else
		{
			$long_question = NULL;
			$exam = NULL;
			$question = array(
				'content'  => $this->input->post('content'),
				'image'    => $img,
				'audio'    => $audio,
				'level'	   => $this->input->post('level'),
				'id_long_question' => $long_question,
				'exam_id' => $exam,
				'group_id' => $this->input->post('group'),
				'updated'  => gmdate('Y-m-d H:i:s', time()+7*3600)
				);
			$result = $this->query_sql->edit('question',$question,array('id'=>$id));
			return $result;
		}
	}
/*
	-Hàm add_check_validation kiểm tra hợp lệ trên form 'content', 'choosecorrect', 'choosecontent1','choosecontent2','choosecontent3','choosecontent4'
	# câu lệnh $this->form_validation->set_rules xét các tập luật cho các form
	#if "numberchoose" = 4 thì xét thêm tập luật cho 'choosecontent4'

	@return thi hành tập luật trong CI


*/
	private function add_check_validation()
	{
		$this->form_validation->set_rules('content','Question','trim|required');

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
	-Hàm thêm add_img thêm file img vào thư mục
	# $album_dir chứa đường dẫn đến file cần lưu './uploads/add_img_files/'
	# if chưa cho có folder của đường dẫn thì tạo folder
	# config['upload_path'] cài đặt đường dẵn lưu file add_img
	# config['allowed_types'] cài đặt đuôi cho phép lưu add_img

	@ return $audio_data dữ liệu file được upload lên
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
	-Hàm thêm audio vào thư mục 
	# $album_dir chứa đường dẫn đến file cần lưu './uploads/audio_files/'
	# if chưa cho có folder của đường dẫn thì tạo folder
	# config['upload_path'] cài đặt đường dẵn lưu file audio
	# config['allowed_types'] cài đặt đuôi cho phép lưu audio

	@ return $audio_data dữ liệu file được upload lên
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
	# thêm giá trị cho cột choice id = "", content , question_id,
	# biến $question_id là id của question của choice
	# $valua là cột lấy giá trị thứ tự của textbox content của choice
	vd: $this->input->post("choosecontent$value") => $this->input->post("choosecontent1").
	# correct_answer là lấy giá trị câu đúng của choice (giá trị 1 hoặc 0)

	@return giá trị thêm choice
*/
	private function add_chosese($question_id,$value,$correct_answer)
	{
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

/*
	-Hàm update_chosese() cập nhật lại giá trị 'content' , 'correct_answer' 'updated' cho bảng choose.
	# $choose_id giá trị id của choose.
	# $valua là cột lấy giá trị thứ tự của textbox content của choice.
	vd: $this->input->post("choosecontent$value") => $this->input->post("choosecontent1").
	# correct_answer là lấy giá trị câu đúng của choice (giá trị 1 hoặc 0).

	@return giá trị choice được cập nhật
*/
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

/*
	-Hàm check_login kiểm tra đã đăng nhập chưa
	# if có sesstion 'addmin'

	@retunr true hoặc false
*/

	public function check_login ()
	{
		if($this->session->has_userdata('admin'))
			return true;
		else return false;
	}

}

/* End of file Question.php */
/* Location: ./application/controllers/admin/Question.php */