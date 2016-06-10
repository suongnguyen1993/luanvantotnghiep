<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cauhoi');
	}

	public function index($id)
	{
		$data['title']='Ôn tập';
		$data['current']='review';
		$data['group']['group']= $this->query_sql->select_array('group',"id, name", "",'',"");
		$data['left_menu']='frontend/element/item/left-menu-review';

		$id_u= $this->session->userdata('id');
	
		
		if(isset($id) && $id == 1)
		{
			$lisPhoto = $this->Cauhoi->getlistening(array('group_id'=>$id,'user_id'=>$id_u));
		
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

					if($data['part1'][$i]['user_choice'] !=0)
					{
						$id1=$data['part1'][$i]['user_choice'];//lấy id_userchoice
			
						foreach($data['part1'] as $id)
						{	
							foreach($id['traloi'] as $tl)
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
									if($tl['correct_answer']==1)
									{
										$qid=$data['part1'][$i]['id'];
										$this->query_sql->del('false_statements',array('user_id' => $id_u, 'question_id' => $qid));
									}
								}
							}
						}
						 
					}//end else

				}
				$this->session->unset_userdata('part1');

			}
		
			else
			{
				$this->session->set_userdata('part1',$data['part1']);
			}

	}

	if (isset($id) && $id == 2)
	{
		$lisques = $this->Cauhoi->getlistening(array('group_id'=>$id,'user_id'=>$id_u));
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

				if($data['part2'][$i]['user_choice'] !=0)
				{
					$id1=$data['part2'][$i]['user_choice'];//lấy id_userchoice
		
					foreach($data['part2'] as $id)
					{	
						foreach($id['traloi'] as $tl)
						{	
							if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
							{
								if($tl['correct_answer']==1)
								{
									$qid=$data['part2'][$i]['id'];
									if($tl['correct_answer']==1)
									{
										$qid=$data['part2'][$i]['id'];
										$this->query_sql->del('false_statements',array('user_id' => $id_u, 'question_id' => $qid));
									}
								}
							}
						}

					}
					 
				}//end else
			}
			$this->session->unset_userdata('part2');  
		}

		else
		{
			$this->session->set_userdata('part2',$data['part2']);
		}
			
	}

	if (isset($id) && $id == 3)
	{
		 $lisshort = $this->Cauhoi->getLongQuestion(array('group_id'=>$id,'user_id'=>$id_u));
        $data['part3']= $lisshort;
		$data['template'] = 'part3';
		if($this->input->post())
		{
			$data['part3'] = $this->session->userdata('part3');
			
			$array_long_id= array();
			$postPart = $this->input->post()['part3'];
				foreach ($data['part3'] as $part3I => $part3V) 
				{	
						$array_long_id[] =  $part3V['id'];
					foreach ($part3V['question'] as $i => $v)
					{
						  
						$data['part3'][$part3I]['question'][$i]['user_choice'] = $postPart[$part3I][$i];	

						//------------------------add câu sai -----------------------

						if(	$data['part3'][$part3I]['question'][$i]['user_choice'] ==0)
						{
							
							$lqid=$part3V['id'];//lấy idlong_ques
							$id_long[]=$lqid;	
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
										$lqid=$part3V['id'];//lấy idlong_ques		
										$id_long[]=$lqid;

									}
								}
							}
					
						}//end else

					
					}

				 
				}


			$xl_trung = array();
			$xl_long_false=$this->XL_long_false_answer($id_long,$xl_trung);
			$del_long_queston = array();

			foreach ($array_long_id as $v)
			{

				if(!in_array($v, $xl_trung))
				{
					$this->query_sql
					->del('false_statements',array('user_id' => $id_u,'long_question_id' => $v));				
				}
			}
			$this->session->unset_userdata('part3');


		}
		else{
			$this->session->set_userdata('part3',$data['part3']);
			}	
	
	}

	if (isset($id) && $id == 4)
		{
			$shorttalk = $this->Cauhoi->getLongQuestion(array('group_id'=>$id,'user_id'=>$id_u));
        	$data['part4']= $shorttalk;
			$data['template'] = 'part4';
			if($this->input->post())
			{
				$data['part4'] = $this->session->userdata('part4');
				$array_long_id = array();
				$postPart = $this->input->post()['part4'];
 				foreach ($data['part4'] as $part4I => $part4V) 
 				{
 					$array_long_id[] =  $part3V['id'];
					foreach ($part4V['question'] as $i => $v)
				 	{					
						$data['part4'][$part4I]['question'][$i]['user_choice'] = $postPart[$part4I][$i];	
						//------------------------add câu sai -----------------------

						if(	$data['part4'][$part4I]['question'][$i]['user_choice'] ==0)
						{

							
							$lqid=$part4V['id'];//lấy idlong_ques
							$id_long[]=$lqid;	
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
									
										$lqid=$part4V['id'];//lấy idlong_ques
										$id_long[]=$lqid;	
									}
								}
							}
						
						 
						}//end else
					}
				}
			$xl_trung = array();
			$xl_long_false=$this->XL_long_false_answer($id_long,$xl_trung);
			$del_long_queston = array();

			foreach ($array_long_id as $v)
			{

				if(!in_array($v, $xl_trung))
				{
					$this->query_sql
					->del('false_statements',array('user_id' => $id_u,'long_question_id' => $v));				
				}
			}
				$this->session->unset_userdata('part4');

			}
			else
			{
				$this->session->set_userdata('part4',$data['part4']);
			}	
		
		}

		if (isset($id) && $id == 5)
		{
			$readsence = $this->Cauhoi->getlistening(array('group_id'=>$id,'user_id'=>$id_u));
      		$data['part5']= $readsence;
			$data['template'] = 'part5';
			if($this->input->post())
			{
				$data['part5'] = $this->session->userdata('part5');
				
				$postPart = $this->input->post()['part5'];
				foreach ($data['part5'] as $i => $v)
				{
					$data['part5'][$i]['user_choice'] = $postPart[$i];

					//------------------------add câu sai -----------------------

					if($data['part5'][$i]['user_choice'] !=0)
					{
						$id1=$data['part5'][$i]['user_choice'];//lấy id_userchoice
			
						foreach($data['part5'] as $id)
						{	
							foreach($id['traloi'] as $tl)
							{	
								if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
								{
									if($tl['correct_answer']==1)
									{
										$qid=$data['part1'][$i]['id'];
										$this->query_sql->del('false_statements',array('user_id' => $id_u, 'question_id' => $qid));
									}
								}
							}
						}
						 
					}//end else
					
				}
				$this->session->unset_userdata('part5');  
			}

			else
			{
				$this->session->set_userdata('part5',$data['part5']);
			}
			
		}

		if (isset($id) && $id == 6)
		{
			$shorttalk = $this->Cauhoi->getLongQuestion(array('group_id'=>$id,'user_id'=>$id_u));
        	$data['part6']= $shorttalk;
			$data['template'] = 'part6';
			if($this->input->post())
			{
				$data['part6'] = $this->session->userdata('part6');
				$array_long_id = array();
				$postPart = $this->input->post()['part6'];
 				foreach ($data['part6'] as $part6I => $part6V) 
 				{
 					$array_long_id[] =  $part3V['id'];
					foreach ($part6V['question'] as $i => $v)
				 	{					
						$data['part6'][$part6I]['question'][$i]['user_choice'] = $postPart[$part6I][$i];	
						//------------------------add câu sai -----------------------

						if(	$data['part6'][$part6I]['question'][$i]['user_choice'] ==0)
						{

							
							$lqid=$part6V['id'];//lấy idlong_ques
							$id_long[]=$lqid;	
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
									
										$lqid=$part6V['id'];//lấy idlong_ques
										$id_long[]=$lqid;	
									}
								}
							}
						
						 
						}//end else
					}
				}
			$xl_trung = array();
			$xl_long_false=$this->XL_long_false_answer($id_long,$xl_trung);
			$del_long_queston = array();

			foreach ($array_long_id as $v)
			{

				if(!in_array($v, $xl_trung))
				{
					$this->query_sql
					->del('false_statements',array('user_id' => $id_u,'long_question_id' => $v));				
				}
			}
				$this->session->unset_userdata('part6');

			}
			else
			{
				$this->session->set_userdata('part6',$data['part6']);
			}	
		
		}
		if (isset($id) && $id == 7)
		{
			$shorttalk = $this->Cauhoi->getLongQuestion(array('group_id'=>$id,'user_id'=>$id_u));
        	$data['part7']= $shorttalk;
			$data['template'] = 'part7';
			if($this->input->post())
			{
				$data['part7'] = $this->session->userdata('part7');
				$array_long_id = array();
				$postPart = $this->input->post()['part7'];
 				foreach ($data['part7'] as $part7I => $part7V) 
 				{
 					$array_long_id[] =  $part3V['id'];
					foreach ($part7V['question'] as $i => $v)
				 	{					
						$data['part7'][$part7I]['question'][$i]['user_choice'] = $postPart[$part7I][$i];	
						//------------------------add câu sai -----------------------

						if(	$data['part7'][$part7I]['question'][$i]['user_choice'] ==0)
						{

							
							$lqid=$part7V['id'];//lấy idlong_ques
							$id_long[]=$lqid;	
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
									
										$lqid=$part7V['id'];//lấy idlong_ques
										$id_long[]=$lqid;	
									}
								}
							}
						
						 
						}//end else
					}
				}
			$xl_trung = array();
			$xl_long_false=$this->XL_long_false_answer($id_long,$xl_trung);
			$del_long_queston = array();

			foreach ($array_long_id as $v)
			{

				if(!in_array($v, $xl_trung))
				{
					$this->query_sql
					->del('false_statements',array('user_id' => $id_u,'long_question_id' => $v));				
				}
			}
				$this->session->unset_userdata('part7');

			}
			else
			{
				$this->session->set_userdata('part7',$data['part7']);
			}	
		
		}


		$data['my_js'] ='frontend/element/foot/my_js/translator_js';
		$this->load->view('frontend/layout/practice',isset($data)?$data:"");
	}

	private function XL_long_false_answer($arr,&$XL_array)
	{
		$arrayUnique = array();
		foreach ($arr as  $value) {
			$arrayUnique[$value] = 1;	
		}
		foreach ($arrayUnique as $k => $v) {
			$XL_array[] = $k;
		}
		return $XL_array;
	}

}

/* End of file review.php */
/* Location: ./application/modules/review/controllers/review.php */