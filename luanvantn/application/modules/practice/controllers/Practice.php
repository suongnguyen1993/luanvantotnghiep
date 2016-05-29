<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Practice extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cauhoi');
	}

	public function index()
	{
		$data['current']='practice';
		$data['title']='Practice';
		$data['content']='Practice with us now.';
		$data['group']['group']= $this->query_sql->select_array('group',"id, name", "",'',"");
		$this->load->view('frontend/layout/practice',$data);
	}

	public function chitiet($id = "")
	{
		
		$data['title']='Luyện tập';
		$data['content']='Hãy luyện tập Toeic với chúng tôi.';
		$data['current1']='practice';
		$data['current']=$id;
		$data['group']['group']= $this->query_sql->select_array('group',"id, name", "",'',"");
		
		$username = $_SESSION["username"]; 
			$id_user= $this->Cauhoi->getid_user($username);
			foreach ($id_user as $idu)
			{
				$id_u=$idu['id'];
			}
		
		// part1
		if(isset($id) && $id == 1)
		{
			
			$lisPhoto = $this->Cauhoi->getlistening(array('group_id'=>$id));
        	$data['part1']= $lisPhoto;
			$data['template'] = 'part1';
			if($this->input->post())
			{
				$data['part1'] = $this->session->userdata('part1');

				$postPart = $this->input->post()['part1'];
				foreach ($data['part1'] as $i => $v)
				 {

					$data['part1'][$i]['user_choice'] = $postPart[$i];


					//------------------------add câu sai -----------------------

					if($data['part1'][$i]['user_choice'] ==0)
					{

						$qid=$data['part1'][$i]['id'];
						// $kt=$this->Cauhoi->kt_id();
						// foreach ($kt as $k)
						// {
						
						
						// if($qid == ($k['question_id']))
						// {
						// 	redirect('.');
							
						// }
						// else
						// {
							$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						//}
						
					//}
					// add question vào false_statement
						
					}
					else 
					{
						$id1=$data['part1'][$i]['user_choice'];//lấy id_userchoice
			
						foreach($data['part1'] as $id)
						{	
							foreach($id['traloi'] as $tl)
						{	
							if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
							{
							if($tl['correct_answer']==0)
							{
								$qid=$data['part1'][$i]['id'];
							// add question vào false_statement
								$data['them'] = array(
								'user_id' => $id_u, 
								'question_id'  => 	$qid	
								);
							
								$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
							}
							}
						}
							
							  
								

						}
						 
					}//end else

				}

			}
		
			else
			{
				$this->session->set_userdata('part1',$data['part1']);
			}
			
			}


			// part2
			if (isset($id) && $id == 2)
		{
			 $lisques = $this->Cauhoi->getlistening(array('group_id'=>$id));
        	$data['part2']= $lisques;
			$data['template'] = 'part2';
			if($this->input->post())
			{
				$data['part2'] = $this->session->userdata('part2');
				
				$postPart = $this->input->post()['part2'];
				foreach ($data['part2'] as $i => $v)
				 {
					$data['part2'][$i]['user_choice'] = $postPart[$i];

					//------------------------add câu sai -----------------------

					if($data['part2'][$i]['user_choice'] ==0)
					{

						$qid=$data['part2'][$i]['id'];
						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part2'][$i]['user_choice'];//lấy id_userchoice
			
						foreach($data['part2'] as $id)
						{	
							foreach($id['traloi'] as $tl)
						{	
							if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
							{
							if($tl['correct_answer']==0)
							{
								$qid=$data['part2'][$i]['id'];
							// add question vào false_statement
								$data['them'] = array(
								'user_id' => $id_u, 
								'question_id'  => 	$qid	
								);
							
								$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
							}
							}
						}
							
							  
								

						}
						 
					}//end else
				}
				  
			}

			else{
				$this->session->set_userdata('part2',$data['part2']);
			}
			
		}

		//part3

		if (isset($id) && $id == 3)
		{
			 $lisshort = $this->Cauhoi->getLongQuestion(array('group_id'=>$id));
            $data['part3']= $lisshort;
			$data['template'] = 'part3';
			if($this->input->post())
			{
				$data['part3'] = $this->session->userdata('part3');

				$postPart = $this->input->post()['part3'];
 				foreach ($data['part3'] as $part3I => $part3V) 
 				{
				foreach ($part3V['question'] as $i => $v)
				 {
					
						$data['part3'][$part3I]['question'][$i]['user_choice'] = $postPart[$part3I][$i];	

						//------------------------add câu sai -----------------------

						if(	$data['part3'][$part3I]['question'][$i]['user_choice'] ==0)
					{


						$qid=$data['part3'][$part3I]['question'][$i]['id'];//lấy id_ques
						

						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part3'][$part3I]['question'][$i]['user_choice'] ;//lấy id_userchoice
						
								foreach($v['traloi'] as $tl )
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
								if($tl['correct_answer']==0)
								{
									$qid=$data['part3'][$part3I]['question'][$i]['id'];
								 	
								 
			
								// add question vào false_statement
									$data['them'] = array(
									'user_id' => $id_u, 
									'question_id'  => 	$qid	
									);
								
									$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
									}
								}
							}
					
					}//end else
						
				}
					 
			}

			}
			else{
				$this->session->set_userdata('part3',$data['part3']);
				}	
		
	}

	//part4

		if (isset($id) && $id == 4)
		{
			 $shorttalk = $this->Cauhoi->getLongQuestion(array('group_id'=>$id));
        $data['part4']= $shorttalk;
			$data['template'] = 'part4';
			if($this->input->post())
			{
				$data['part4'] = $this->session->userdata('part4');

				$postPart = $this->input->post()['part4'];
 				foreach ($data['part4'] as $part4I => $part4V) 
 				{
				foreach ($part4V['question'] as $i => $v)
				 {
					
						$data['part4'][$part4I]['question'][$i]['user_choice'] = $postPart[$part4I][$i];	


						//------------------------add câu sai -----------------------

						if(	$data['part4'][$part4I]['question'][$i]['user_choice'] ==0)
					{

						$qid=$data['part4'][$part4I]['question'][$i]['id'];
						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part4'][$part4I]['question'][$i]['user_choice'] ;//lấy id_userchoice
			
						
								foreach($v['traloi'] as $tl)
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
								if($tl['correct_answer']==0)
								{
									$qid=$data['part4'][$part4I]['question'][$i]['id'];
								// add question vào false_statement
									$data['them'] = array(
									'user_id' => $id_u, 
									'question_id'  => 	$qid	
									);
								
									$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
									}
								}
							}
						
						 
					}//end else
					
						
				}
					 
			}

			}
			else{
				$this->session->set_userdata('part4',$data['part4']);
				}	
		
	}


	// part5
			if (isset($id) && $id == 5)
		{
			 $readsence = $this->Cauhoi->getreading(array('group_id'=>$id));
      		  $data['part5']= $readsence;
			$data['template'] = 'part5';
			if($this->input->post())
			{
				$data['part5'] = $this->session->userdata('part5');
				
				$postPart = $this->input->post()['part5'];
				foreach ($data['part5'] as $i => $v) {
					$data['part5'][$i]['user_choice'] = $postPart[$i];

					//------------------------add câu sai -----------------------

					if($data['part5'][$i]['user_choice'] ==0)
					{

						$qid=$data['part5'][$i]['id'];
						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part5'][$i]['user_choice'];//lấy id_userchoice
			
						foreach($data['part5'] as $id)
						{	
							foreach($id['traloi'] as $tl)
						{	
							if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
							{
							if($tl['correct_answer']==0)
							{
								$qid=$data['part5'][$i]['id'];
							// add question vào false_statement
								$data['them'] = array(
								'user_id' => $id_u, 
								'question_id'  => 	$qid	
								);
							
								$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
							}
							}
						}
							
							  
								

						}
						 
					}//end else
					
				}
				  
			}

			else{
				$this->session->set_userdata('part5',$data['part5']);
			}
			
		}


		//part6

		if (isset($id) && $id == 6)
		{
			 $readtext = $this->Cauhoi->getLongQuestion(array('group_id'=>$id));
        $data['part6']= $readtext;
			$data['template'] = 'part6';
			if($this->input->post())
			{
				$data['part6'] = $this->session->userdata('part6');

				$postPart = $this->input->post()['part6'];
 				foreach ($data['part6'] as $part6I => $part6V) 
 				{
				foreach ($part6V['question'] as $i => $v)
				 {
					
						$data['part6'][$part6I]['question'][$i]['user_choice'] = $postPart[$part6I][$i];	
					
						//------------------------add câu sai -----------------------

						if(	$data['part6'][$part6I]['question'][$i]['user_choice'] ==0)
					{

						$qid=$data['part6'][$part6I]['question'][$i]['id'];
						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part6'][$part6I]['question'][$i]['user_choice'] ;//lấy id_userchoice
			
								foreach($v['traloi'] as $tl)
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
								if($tl['correct_answer']==0)
								{
									$qid=$data['part6'][$part6I]['question'][$i]['id'];
								// add question vào false_statement
									$data['them'] = array(
									'user_id' => $id_u, 
									'question_id'  => 	$qid	
									);
								
									$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
									}
								}
							}
					
						 
					}//end else
				}
					 
			}

			}
			else{
				$this->session->set_userdata('part6',$data['part6']);
				}	
		
	}	

		//part7

		if (isset($id) && $id == 7)
		{
			$readcom = $this->Cauhoi->getLongQuestion(array('group_id'=>$id));
        $data['part7']= $readcom;
			$data['template'] = 'part7';
			if($this->input->post())
			{
				$data['part7'] = $this->session->userdata('part7');

				$postPart = $this->input->post()['part7'];
 				foreach ($data['part7'] as $part7I => $part7V) 
 				{
				foreach ($part7V['question'] as $i => $v)
				 {
					
						$data['part7'][$part7I]['question'][$i]['user_choice'] = $postPart[$part7I][$i];	
					
						//------------------------add câu sai -----------------------

						if(	$data['part7'][$part7I]['question'][$i]['user_choice'] ==0)
					{

						$qid=$data['part7'][$part7I]['question'][$i]['id'];
						$data['them'] = array(
						'user_id' => $id_u, 
						'question_id'  => 	$qid	
						);
						
						$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
						}
					else 
					{
						$id1=$data['part7'][$part7I]['question'][$i]['user_choice'] ;//lấy id_userchoice
			
								foreach($v['traloi'] as $tl)
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
								if($tl['correct_answer']==0)
								{
									$qid=$data['part7'][$part7I]['question'][$i]['id'];
								// add question vào false_statement
									$data['them'] = array(
									'user_id' => $id_u, 
									'question_id'  => 	$qid	
									);
								
									$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
									}
								}
							}
						
						 
					}//end else
				}
					 
			}

			}
			else{
				$this->session->set_userdata('part7',$data['part7']);
				}	
		
	}


	$this->load->view('frontend/layout/practice',isset($data)?$data:"");
}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */