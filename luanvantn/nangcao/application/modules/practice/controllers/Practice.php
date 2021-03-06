<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Practice extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Cauhoi');
		$this->load->model('M_irt');
		$this->load->library('Myirt');
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
		$data['left_menu']='frontend/element/item/left-menu';
		$data['current']=$id;
		$data['group']['group']= $this->query_sql->select_array('group',"id, name", "",'',"");
		if($this->session->has_userdata('username'))
		{
			
			$id_u= $this->session->userdata('id');
			if(isset($id) && $id == 1)
			{
				
				$lisPhoto = $this->Cauhoi->getlistening(array('group_id'=>$id));
				$data['part1']= $lisPhoto;

				$data['template'] = 'part1';
				
				
				if($this->input->post())
				{
					$data['submit'] = 1;
					$data['part1'] = $this->session->userdata('part1');

					$postPart = $this->input->post()['part1'];
					foreach ($data['part1'] as $i => $v)
					{

						$data['part1'][$i]['user_choice'] = $postPart[$i];


					//------------------------add câu sai -----------------------

						if($data['part1'][$i]['user_choice'] ==0)
						{

							$qid=$data['part1'][$i]['id'];
							$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
								'question_id' => $qid),"");
							if(empty($check_id_false))
							{
								
								$data['them'] = array(
									'user_id' => $id_u, 
									'question_id'  => 	$qid	
									);
								$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
							}
							
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

										$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
											'question_id' => $qid),"");
										if(empty($check_id_false))
										{
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


			// part2
		if (isset($id) && $id == 2)
		{
			$lisques = $this->Cauhoi->getlistening(array('group_id'=>$id));
			$data['part2']= $lisques;
			$data['template'] = 'part2';
			if($this->input->post())
			{
				$data['submit'] = 1;
				$data['part2'] = $this->session->userdata('part2');
				
				$postPart = $this->input->post()['part2'];
				foreach ($data['part2'] as $i => $v)
				{
					$data['part2'][$i]['user_choice'] = $postPart[$i];

					//------------------------add câu sai -----------------------

					if($data['part2'][$i]['user_choice'] ==0)
					{

						$qid=$data['part2'][$i]['id'];

						$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
							'question_id' => $qid),"");
						if(empty($check_id_false))
						{

							$data['them'] = array(
								'user_id' => $id_u, 
								'question_id'  => 	$qid	
								);
							
							
							$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);
						}	
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

										$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
											'question_id' => $qid),"");
										if(empty($check_id_false))
										{
											$data['them'] = array(
												'user_id' => $id_u, 
												'question_id'  => 	$qid	
												);
											
											$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
										}
									}
								}
							}

						}
						
					}//end else
				}
				$this->session->unset_userdata('part2');  
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
				$data['submit'] = 1;
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

				//add cau sai
				foreach ($xl_long_false as $idl)
				{

					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,'long_question_id' => $idl),"");
					if(empty($check_id_false))
					{
						$false=array(
							'id'=>'',
							'long_question_id'=> $idl,
							'user_id'=> $id_u
							);
						$this->Cauhoi->addfalsestatement('false_statements',$false);
					}
				}
				$this->session->unset_userdata('part3');


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
				$data['submit'] = 1;
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

				//add cau sai
				foreach ($xl_long_false as $idl)
				{
					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,'long_question_id' => $idl),"");
					if(empty($check_id_false))
					{
						$false=array(
							'id'=>'',
							'long_question_id'=> $idl,
							'user_id'=> $id_u
							);
						$this->Cauhoi->addfalsestatement('false_statements',$false);
					}
				}
				$this->session->unset_userdata('part4');

			}
			else
			{
				$this->session->set_userdata('part4',$data['part4']);
			}	
			
		}


	// part5
		if (isset($id) && $id == 5)
		{
			$id_u = $this->session->userdata('id');
			$du_lieu_user = $this->M_irt->get_1_user($id_u);

			$dulieu_a_b = $this->M_irt->get_a_b_20();
			foreach ($dulieu_a_b as $value) {
				$do_kho_thuc[$value['id']] = $value['do_kho_thuc'];
				$do_phan_biet[$value['id']] = $value['do_phan_biet'];
			}
			$level = $this->query_sql->select_row('user',"level",array('id'=>$id_u));
			
			foreach ($do_kho_thuc as $cauhoi => $b) 
			{
				$thong_tin[$cauhoi] = $this->myirt->ham_thong_tin_cau_hoi($level['level'],$b,$do_phan_biet[$cauhoi]);		
			}
			
			$tmp = array();
			foreach ($thong_tin as $key => $thongtin) 
			{
				$check_key = $this->query_sql->select_row('tam',"*",array('id_question' => $key,'id_user' =>$id_u));
				
				if(empty($check_key))
				{
					$tmp = array(
							'id_question' => $key,
							'thong_tin' =>$thongtin,
							'id_user' =>$id_u
							);
					$this->query_sql->add('tam',$tmp );
				}
				else
				{
					$tmp = array(
							'thong_tin' =>$thongtin
							);
					$this->query_sql->edit('tam',$tmp,array('id_user' =>$id_u,'id_question' => $key) );
				}
			}
			
			$readsence = $this->Cauhoi->getreading_irt($id_u);			
			
			$data['part5']= $readsence;
			$data['template'] = 'part5';
			if($this->input->post())
			{
				$data['submit'] = 1;
				$data['part5'] = $this->session->userdata('part5');
				
				$postPart = $this->input->post()['part5'];
				foreach ($data['part5'] as $i => $v)
				{
					$matran = array(
						'id_question' =>$v['id'],
						'id_user'	  =>$id_u
						);
					
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
						$matran['trloi'] = 0;
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
											$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
												'question_id' => $qid),"");
											if(empty($check_id_false))
											{
												$data['them'] = array(
													'user_id' => $id_u, 
													'question_id'  => 	$qid	
													);
												
												$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
											}
											$matran['trloi'] = 0;
										}
										else
										{
											$matran['trloi'] = 1;

										}
									}
								}
							}
							
						}//end else
						
							
						$check_key_ma_tran = $this->query_sql->select_row('ma_tran_tra_loi',$matran,array("id_question"=>$matran['id_question'],"id_user"=>$matran['id_user']),'');
						if(empty($check_key_ma_tran)){
							$this->Cauhoi->add('ma_tran_tra_loi', $matran);
						}
						else
						{
							$this->query_sql->edit("ma_tran_tra_loi",$matran,array("id_question"=>$matran['id_question'],"id_user"=>$matran['id_user']));
						}
						
					}

					$du_lieu_user = $this->M_irt->get_1_user($id_u);
					foreach ($du_lieu_user as $value) 
					{
						$user_trloi[$id_u][$value['id_question']] = $value['trloi'];
					}
					// print_r($user_trloi);
					foreach ($user_trloi as $k => $v) 
					{
						$theta['level_bd'] = $level['level'];
						//xu ly level
						$level_user = $this->myirt->chuyen_level_thanh_ty_so($level['level']);
						if($level_user != 0)
						{
							$level1 = log($level_user/(1-$level_user));
						}
						else $level1 = 0;
						
						//tinh SE
						$SE=$this->myirt->SE($do_kho_thuc,$do_phan_biet,$level1);
						//echo $SE;
						//kiem tr nguoi dung tr loi dung het hoac sai het
						$tong_trloi = count($v);
						$dem = 0;
						foreach ($v as $e) {
							if($e == 1)
								{$dem +=1;}
						}
						$tong_dung = $dem;
						$tong_trloi;
						if($tong_dung != 0 && $tong_dung !=$tong_trloi )
						{ 
							if($SE <1.6 )
							{
									//$theta[$k]=$this->myirt->likelihood($v,$do_kho_thuc,$do_phan_biet,$level1);
								$level_ln = $this->myirt->likelihood($v,$do_kho_thuc,$do_phan_biet,$level1);
								if($level_ln<=-3)
								{
									$theta[$k]=0;
								}
								if($level_ln>=3)
								{
									$theta[$k]=990;
								}
								else 
								{
									$theta[$k] = (int)$this->myirt->chuyen_ln_thanh_level($level_ln);
								}
								$updateuser = array(
									'level'=>$theta[$k]
									);
								//$this->query_sql->edit('user',$updateuser, array('id'=>$id_u));

							}
							else $theta[$k]='Chưa cập nhật được năng lực';	
						}
						else $theta[$k]='Chưa cập nhật được năng lực';	
						
						$data['nanglucbd'] = $level['level'];
						
						$data['nanglucmoi'] = $theta[$k];
					}
					

					$this->session->unset_userdata('part5');  
				}

				else
				{
					$this->session->set_userdata('part5',$data['part5']);
					$theta['level_bd'] = $level['level'];
					$level_user = $this->myirt->chuyen_level_thanh_ty_so($level['level']);
					if($level_user != 0)
					{
						$level = log($level_user/(1-$level_user));
					}
					else $level = 0;
					$data['nanglucbd'] = $theta['level_bd'];

				}				
			}


		// irt mô hình 1 tham số
		// if (isset($id) && $id == 5)
		// {
		// 	$id_u = $this->session->userdata('id');
		// 	$du_lieu_user = $this->M_irt->get_1_user($id_u);

		// 	$dulieu_a_b = $this->M_irt->get_a_b_5();
		// 	foreach ($dulieu_a_b as $value) {
		// 		$do_kho_thuc[$value['id']] = $value['do_kho_thuc'];
		// 	}
		// 	$level = $this->query_sql->select_row('user',"level",array('id'=>$id_u));
			
		// 	foreach ($do_kho_thuc as $cauhoi => $b) 
		// 	{
		// 		$thong_tin[$cauhoi] = $this->myirt->ham_thong_tin_cau_hoi_1_tham_so($level['level'],$b);		
		// 	}
		// 	// print_r($thong_tin);
		// 	$tmp = array();
		// 	foreach ($thong_tin as $key => $thongtin) 
		// 	{
		// 		$check_key = $this->query_sql->select_row('tam',"*",array('id_question' => $key,'id_user' =>$id_u));
				
		// 		if(empty($check_key))
		// 		{
		// 			$tmp = array(
		// 					'id_question' => $key,
		// 					'thong_tin' =>$thongtin,
		// 					'id_user' =>$id_u
		// 					);
		// 			$this->query_sql->add('tam',$tmp );
		// 		}
		// 	}
			
		// 	$readsence = $this->Cauhoi->getreading_irt($id_u);			
			
		// 	$data['part5']= $readsence;
		// 	$data['template'] = 'part5';
		// 	if($this->input->post())
		// 	{
		// 		$data['submit'] = 1;
		// 		$data['part5'] = $this->session->userdata('part5');
				
		// 		$postPart = $this->input->post()['part5'];
		// 		foreach ($data['part5'] as $i => $v)
		// 		{
		// 			$matran = array(
		// 				'id_question' =>$v['id'],
		// 				'id_user'	  =>$id_u
		// 				);
					
		// 			$data['part5'][$i]['user_choice'] = $postPart[$i];

		// 				//------------------------add câu sai -----------------------

		// 			if($data['part5'][$i]['user_choice'] ==0)
		// 			{

		// 				$qid=$data['part5'][$i]['id'];
		// 				$data['them'] = array(
		// 					'user_id' => $id_u, 
		// 					'question_id'  => 	$qid	
		// 					);
						
		// 				$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
		// 				$matran['trloi'] = 0;
		// 			}
		// 			else 
		// 			{
		// 					$id1=$data['part5'][$i]['user_choice'];//lấy id_userchoice
							
		// 					foreach($data['part5'] as $id)
		// 					{	
		// 						foreach($id['traloi'] as $tl)
		// 						{	
		// 							if(isset($tl['id'])&&($tl['id'])==$id1)//lấy dl nếu id_userchoice trong câu hỏi = id_userchoice
		// 							{
		// 								if($tl['correct_answer']==0)
		// 								{
		// 									$qid=$data['part5'][$i]['id'];
		// 								// add question vào false_statement
		// 									$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,
		// 										'question_id' => $qid),"");
		// 									if(empty($check_id_false))
		// 									{
		// 										$data['them'] = array(
		// 											'user_id' => $id_u, 
		// 											'question_id'  => 	$qid	
		// 											);
												
		// 										$flag = $this->Cauhoi->addfalsestatement('false_statements',$data['them']);	
		// 									}
		// 									$matran['trloi'] = 0;
		// 								}
		// 								else
		// 								{
		// 									$matran['trloi'] = 1;

		// 								}
		// 							}
		// 						}
		// 					}
							
		// 				}//end else
						
							
		// 				$check_key_ma_tran = $this->query_sql->select_row('ma_tran_tra_loi',$matran,array("id_question"=>$matran['id_question'],"id_user"=>$matran['id_user']),'');
		// 				if(empty($check_key_ma_tran)){
		// 					$this->Cauhoi->add('ma_tran_tra_loi', $matran);
		// 				}
		// 				else
		// 				{
		// 					$this->query_sql->edit("ma_tran_tra_loi",$matran,array("id_question"=>$matran['id_question'],"id_user"=>$matran['id_user']));
		// 				}
						
		// 			}

		// 			$du_lieu_user = $this->M_irt->get_1_user($id_u);
		// 			foreach ($du_lieu_user as $value) 
		// 			{
		// 				$user_trloi[$id_u][$value['id_question']] = $value['trloi'];
		// 			}
		// 			// print_r($user_trloi);
		// 			foreach ($user_trloi as $k => $v) 
		// 			{
		// 				//xu ly level
		// 				$level_user = $this->myirt->chuyen_level_thanh_ty_so($level['level']);
		// 				if($level_user != 0)
		// 				{
		// 					$level = log($level_user/(1-$level_user));
		// 				}
		// 				else $level = 0;
						
		// 				//tinh SE
		// 				$SE=$this->myirt->SE_1_tham_so($do_kho_thuc,$level);
		// 				// echo $SE;
		// 				//kiem tr nguoi dung tr loi dung het hoac sai het
		// 				$tong_trloi = count($v);
		// 				$dem = 0;
		// 				foreach ($v as $e) {
		// 					if($e == 1)
		// 						{$dem +=1;}
		// 				}
		// 				$tong_dung = $dem;
		// 				$tong_trloi;
		// 				if($tong_dung != 0 && $tong_dung !=$tong_trloi )
		// 				{ 
		// 					if($SE <1.6 )
		// 					{
		// 							$theta[$k]=$this->myirt->likelihood_1_tham_so($v,$do_kho_thuc,$level);
		// 					}
		// 					else $theta[$k]='Chưa cập nhật được năng lực';	
		// 				}
		// 				else $theta[$k]='Chưa cập nhật được năng lực';	
		// 				$theta['level_bd'] = $level;
		// 				$data['nanglucbd'] = $theta['level_bd'];
		// 				$data['nanglucmoi'] = $theta[$k];
		// 			}
					

		// 			$this->session->unset_userdata('part5');  
		// 		}

		// 		else
		// 		{
		// 			$this->session->set_userdata('part5',$data['part5']);
		// 			$level_user = $this->myirt->chuyen_level_thanh_ty_so($level['level']);
		// 			if($level_user != 0)
		// 			{
		// 				$level = log($level_user/(1-$level_user));
		// 			}
		// 			else $level = 0;
		// 			$theta['level_bd'] = $level;
		// 			$data['nanglucbd'] = $theta['level_bd'];

		// 		}				
		// 	}
		//part6

			if (isset($id) && $id == 6)
			{
				$readtext = $this->Cauhoi->getLongQuestion(array('group_id'=>$id));
				$data['part6']= $readtext;
				$data['template'] = 'part6';
				if($this->input->post())
				{
					$data['submit'] = 1;
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

				//add cau sai
				foreach ($xl_long_false as $idl)
				{
					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,'long_question_id' => $idl),"");
					if(empty($check_id_false))
					{
						$false=array(
							'id'=>'',
							'long_question_id'=> $idl,
							'user_id'=> $id_u
							);
						$this->Cauhoi->addfalsestatement('false_statements',$false);
					}
				}
				$this->session->unset_userdata('part6');
			}
			else
			{
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
				$data['submit'] = 1;
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

				//add cau sai
				foreach ($xl_long_false as $idl)
				{
					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_u,'long_question_id' => $idl),"");
					if(empty($check_id_false))
					{
						$false=array(
							'id'=>'',
							'long_question_id'=> $idl,
							'user_id'=> $id_u
							);
						$this->Cauhoi->addfalsestatement('false_statements',$false);
					}
				}

				$this->session->unset_userdata('part7');
			}
			else
			{
				$this->session->set_userdata('part7',$data['part7']);
			}	
			
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

public function irt($id_u = null)
{

	$id_u = $this->session->userdata('id');
	

	$dulieu_a_b = $this->M_irt->get_a_b_20();
	foreach ($dulieu_a_b as $value) {
		$do_kho_thuc[$value['id']] = $value['do_kho_thuc'];
		$do_phan_biet[$value['id']] = $value['do_phan_biet'];
	}
	
	$level = $this->query_sql->select_row('user',"level",array('id'=>$id_u));
	
	foreach ($do_kho_thuc as $cauhoi => $b) 
	{
		$thong_tin[$cauhoi] = $this->myirt->ham_thong_tin_cau_hoi($level['level'],$b,$do_phan_biet[$cauhoi]);		
	}
	print_r($thong_tin);
	$tmp = array();
	foreach ($thong_tin as $key => $thongtin) 
	{
		$check_key = $this->query_sql->select_row('tam',"*",array('id_question' => $key,'id_user' =>$id_u));
		
		if(empty($check_key))
		{
			$tmp = array(
					'id_question' => $key,
					'thong_tin' =>$thongtin,
					'id_user' =>$id_u
					);
			$this->query_sql->add('tam',$tmp );
		}
	}
	$du_lieu_user = $this->M_irt->get_1_user($id_u);
	foreach ($du_lieu_user as $value) 
	{
		$user_trloi[$id_u][$value['id_question']] = $value['trloi'];
	}
	print_r($user_trloi);
	foreach ($user_trloi as $k => $v) 
	{
		//xu ly level
		$level_user = $this->myirt->chuyen_level_thanh_ty_so(500);
		if($level_user != 0)
		{
			$level = log($level_user);
		}
		else $level = 0;
		
		//tinh SE
		$SE=$this->myirt->SE($do_kho_thuc,$level);
		
		//kiem tr nguoi dung tr loi dung het hoac sai het
		$tong_trloi = count($v);
		$dem = 0;
		foreach ($v as $e) {
			if($e == 1)
				{$dem +=1;}
		}
		$tong_dung = $dem;
		if($SE <1.5 )
		{
			if($tong_dung !=0 || $tong_dung !=$tong_trloi )
			{
				$theta[$k]=$this->myirt->likelihood($v,$do_kho_thuc,$do_phan_biet,$level);
			}
		}		
	}

	foreach ($do_kho_thuc as $cauhoi => $b) 
	{
		$thong_tin[$cauhoi] = $this->myirt->ham_thong_tin_cau_hoi($level,$b,$do_phan_biet[$cauhoi]);		
	}

	$tmp = array();
	foreach ($thong_tin as $key => $thongtin) 
	{
		$check_key = $this->query_sql->select_row('tam',"*",array('id_question' => $key,'id_user' =>$id_u),'');
		
		if(empty($check_key))
		{
				$tmp = array(
				'id_question' => $key,
				'thong_tin' =>$thongtin,
				'id_user' =>$id_u
			);
				$this->query_sql->add('tam',$tmp );
		}
	}
}


}


/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */