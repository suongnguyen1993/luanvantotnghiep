<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mini_test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Mytest');
	}

	public function index()
	{
		$data['group']['current'] = "minitest" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['choice'] =$this->query_sql->select_array("choice", "*", "",'','');
		$id_user = $this->session->userdata('id');
		$data_user = $this->query_sql->select_row('user','level',array('id'=>$id_user));
		if($data_user['level'] == 0)
		{
			$data['error'] = 1;
		}
		
		//POST
		if($this->input->post())
		{


			$data['submit'] = 1; 
			$data['part1'] = $this->session->userdata('part1');
			$data['part2'] = $this->session->userdata('part2');
			$data['part3'] = $this->session->userdata('part3');
			$data['part4'] = $this->session->userdata('part4');
			$data['part5'] = $this->session->userdata('part5');
			$data['part6'] = $this->session->userdata('part6');
			$data['part7'] = $this->session->userdata('part7');

			//post ket qua tra ve id choice
			$part1 = $this->addShortUserChoice('part1', $data);
			$part2 = $this->addShortUserChoice('part2', $data);
			$part3 = $this->addLongUserChoice('part3', $data);
			$part4 = $this->addLongUserChoice('part4', $data);
			$part5 = $this->addShortUserChoice('part5', $data);
			$part6 = $this->addLongUserChoice('part6', $data);
			$part7 = $this->addLongUserChoice7('part7', $data);
			
			//neu user tra loi sai thi add vao on cau hoi
			if($this->session->has_userdata('username'))
			{
				
				//xac dinh nguoi dung chon cau sai
				$short_false_answer = array();
				$long_false_answer = array();
				$this->short_false_answer($data['part1'],$short_false_answer);
				$this->short_false_answer($data['part2'],$short_false_answer);
				$this->long_false_answer($data['part3'],$long_false_answer);
				$this->long_false_answer($data['part4'],$long_false_answer);
				$this->short_false_answer($data['part5'],$short_false_answer);
				$this->long_false_answer($data['part6'],$long_false_answer);
				$this->long_false_answer7($data['part7'],$long_false_answer);

				$xl_trung = array();

				$XL_long_false_answer = $this->XL_long_false_answer($long_false_answer,$xl_trung); 


				//luu cau sai
				foreach ($short_false_answer as  $value) 
				{

					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_user,
						'question_id' => $value),"");
		

					if(empty($check_id_false))
					{
						$false_statements = array(
							
							'user_id'	=> $id_user,
							'question_id' => $value
							);
						 $this->query_sql->add('false_statements',$false_statements);	
					}
				
					
					
				}


				foreach ($XL_long_false_answer as  $value) 
				{

					$check_id_false = $this->query_sql->select_row("false_statements","*",array('user_id'	=> $id_user,
						'long_question_id' => $value),"");

					if(empty($check_id_false))
					{
					$false_statements = array(
						
						'user_id'	=> $id_user,
						'long_question_id' => $value
						);
					 $this->query_sql->add('false_statements',$false_statements);
					}
				}
			}

			//tinh cau dung
			$tongsocaudung = 0;

			$socaudungnghe = $this->socaudungnghe($part1,$part2,$part3,$part4);
			$socaudungdoc = $this->socaudungdoc($part5,$part6,$part7);
			$tongsocaudung = $socaudungnghe + $socaudungdoc;
			$data['tongsocaudung'] = $tongsocaudung;

			//tinh diem
			$tongdiem = 0;
			$diemnghe = $this->mytest->diemnghe_minitest($socaudungnghe);
			$diemdoc = $this->mytest->diemdoc_minitest($socaudungdoc);
			$tongdiem = ($diemnghe + $diemdoc)*2 ;
			$data['tongdiem'] = $tongdiem;

			$huysess = array("part1","part2","part3","part4","part5","part6","part7");
			$this->session->unset_userdata($huysess);
		}
		//GET
		else
		{
			$data['part1'] = $this->part1(0,5);
			$data['part2'] = $this->part2(0,20);
			$data['part3'] = $this->part3(0,5);
			$data['part4'] = $this->part4(0,5);
			$data['part5'] = $this->part5(0,20);
			$data['part6'] = $this->part6(0,4);
			$data['part7'] = $this->mini_part7();

			$array = array(
				'part1' => $data['part1'],
				'part2' => $data['part2'],
				'part3' => $data['part3'],
				'part4' => $data['part4'],
				'part5' => $data['part5'],
				'part6' => $data['part6'],
				'part7' => $data['part7']
			);
			
			$this->session->set_userdata( $array );
		}
		$data['template'] = 'mini_test/testtoeic';
		$data['title'] ='kiểm Tra Mini Test';
		$data['my_js'] ='frontend/element/foot/my_js/mini_test_js';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
	}
	private function short_false_answer(&$data = "",&$false_answer = array())
	{
		foreach ($data as $p1)
		 {
			if($p1['user_choice'] == 0)
			{
				$false_answer[] = $p1['id'];
			}
			else
			{
				$a = $this->query_sql->select_row('choice','id,correct_answer',array('id'=>$p1['user_choice']));
				if($a['correct_answer'] == 0)
				{
					$false_answer[] = $p1['id'];
				}
			}
		}
		return $false_answer;
	}
	private function long_false_answer(&$data = "",&$false_answer = array())
	{
		foreach ($data as $p2 ) 
		{			
			foreach ($p2['question'] as $p1)
			{

				if($p1['user_choice'] == 0)
				{
					$false_answer[] = $p1['id'];
				}
				else
				{
					$a = $this->query_sql->select_row('choice','id,correct_answer',array('id'=>$p1['user_choice']));
					if($a['correct_answer'] == 0)
					{
						$false_answer[] = $p1['id'];
					}
				}
			}
		}
	}

	private function long_false_answer7(&$data = "",&$false_answer = array())
	{
		foreach ($data as $p0 ) 
		{
			foreach ($p0 as $p2 ) 
			{			
				foreach ($p2['question'] as $p1)
				{

					if($p1['user_choice'] == 0)
					{

						$false_answer[] = $p2['id'];
					}
					else
					{
						
						$a = $this->query_sql->select_row('choice','id,correct_answer',array('id'=>$p1['user_choice']));
						if($a['correct_answer'] == 0)
						{
							$false_answer[] = $p2['id'];
						}
					}
				}
			}
		}
	}

	private function addShortUserChoice($part, &$data)
	{
		$postPart = isset($this->input->post()[$part])?$this->input->post()[$part]:0;
		if(!$postPart)
		{
			return array();
		}
		foreach ($data[$part] as $i => $record) {
				if(isset($postPart[$i]))
				{
					$data[$part][$i]['user_choice'] = $postPart[$i];	
				}
				else
				{
					$data[$part][$i]['user_choice'] = 0;
				}		
		}
			return $postPart;
	}

	private function addLongUserChoice($part, &$data)
	{
		$postPart = isset($this->input->post()[$part])?$this->input->post()[$part]:0;
		if(!$postPart)
		{
			return array();
		}
			foreach ($data[$part] as $part3I => $part3V) {
				foreach ($part3V['question'] as $i => $record) {
					if(isset($postPart[$part3I][$i]))
					{
						$data[$part][$part3I]['question'][$i]['user_choice'] = $postPart[$part3I][$i];	
					}
					else
					{
						$data[$part][$part3I]['question'][$i]['user_choice'] = 0;
					}		
				}
			}
		return $postPart;
	}
	private function addLongUserChoice7($part, &$data)
	{
		$postPart = isset($this->input->post()[$part])?$this->input->post()[$part]:0;
		if(!$postPart)
		{
			return array();
		}
		foreach($data[$part] as $part7I => $part7V)
		{
			foreach ($part7V as $part3I => $part3V) {
				foreach ($part3V['question'] as $i => $record) {
					if(isset($postPart[$part3I][$i]))
					{
						$data[$part][$part7I][$part3I]['question'][$i]['user_choice'] = $postPart[$part3I][$i];	
					}
					else
					{
						$data[$part][$part7I][$part3I]['question'][$i]['user_choice'] = 0;
					}		
				}
			}
		}
		return $postPart;
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

	private function part1 ($start = "", $limit = "")
	{
		$result = $this->query_sql->getRandomQuesion_ChoiceNotRandChoice(array('group_id'=>1),$start, $limit);

		return $result;
	}
	private function part2($start = "", $limit = "")
	{
		$result = $this->query_sql->getRandomQuesion_ChoiceNotRandChoice(array('group_id'=>2),$start, $limit);

		return $result;
	}
	private function part3($start = "", $limit = "")
	{
		$result = $this->query_sql->getRandomLong_QuestionRandom(array('group_id'=>3), $start, $limit);
		return $result;
	}
	private function part4($start = "", $limit = "")
	{
		$result = $this->query_sql->getRandomLong_QuestionRandom(array('group_id'=>4), $start,$limit);
		return $result;
	}
	private function part5($start = "", $limit = "")
	{
		$result = $this->query_sql->getQuesionChoiceRandom(array('group_id'=>5), $start, $limit);
		return $result;
	}
	private function part6($start = "", $limit = "")
	{
		$result = $this->query_sql->getLongQuestionRandom(array('group_id'=>6), $start,$limit);
		return $result;
	}
	// private function part7($start = "", $limit = "")
	// {

	// 	$result = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7), $start, $limit);
	// 	return $result;
	// }
	private function mini_part7($start = "", $limit = "")
	{
		
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>2),0,1);
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>3),0,1);
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>4),0,2);
		
		return $a;
	}
	public function socaudungnghe($part1,$part2,$part3,$part4)
	{
		$diemnghe = 0;
		foreach($part1 as $id)
		{

			$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
			
			if($id!=0)
			{
				if($answer['correct_answer'] == 1)
					$diemnghe +=1;
			}
		}
		foreach($part2 as $id)
		{

			$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
			
			if($id!=0)
			{
				if($answer['correct_answer'] == 1)
					$diemnghe +=1;
			}
		}
		foreach ($part3 as $q) 
		{

			foreach($q as $id)
			{

				$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
				
				if($id!=0)
				{
					if($answer['correct_answer'] == 1)
						$diemnghe +=1;
				}
			}
		}
		foreach ($part4 as $q) 
		{

			foreach($q as $id)
			{

				$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
				
				if($id!=0)
				{
					if($answer['correct_answer'] == 1)
						$diemnghe +=1;
				}
			}
		}
		return $diemnghe;
	}
	public function socaudungdoc($part5,$part6,$part7)
	{
		$diemdoc = 0;
		foreach($part5 as $id)
			{

				$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
				
				if($id!=0)
				{
					if($answer['correct_answer'] == 1)
						$diemdoc +=1;
				}
			}
			foreach ($part6 as $q) 
			{

				foreach($q as $id)
				{

					$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
					
					if($id!=0)
					{
						if($answer['correct_answer'] == 1)
							$diemdoc +=1;
					}
				}
			}
			foreach ($part7 as $q) 
			{

				foreach($q as $id)
				{

					$answer = $this->query_sql->select_row("choice",'correct_answer',array('id'=>$id),'');
					
					if($id!=0)
					{
						if($answer['correct_answer'] == 1)
							$diemdoc +=1;
					}
				}
			}
			return $diemdoc;
	}

	
	
	

}

/* End of file test.php */
/* Location: ./application/modules/test/controllers/test.php */