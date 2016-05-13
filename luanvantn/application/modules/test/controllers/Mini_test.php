<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mini_test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function mini_test()
	{
		$data['group']['current'] = "minitest" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['choice'] =$this->query_sql->select_array("choice", "*", "",'','');

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
			//$part7 = $this->addLongUserChoice('part7', $data);
			$part7 = $this->addLongUserChoice7('part7', $data);
			// echo "<pre>";

			// print_r($data['part7']);
			// print_r($part7);
			// die;

			//neu user tra loi sai thi add vao on cau hoi
			if($this->session->has_userdata('username'))
			{
				$id_user = $this->session->userdata('id');
				//xac dinh nguoi dung chon cau sai
				$false_answer = array();
				$this->short_false_answer($data['part1'],$false_answer);
				$this->short_false_answer($data['part2'],$false_answer);
				$this->long_false_answer($data['part3'],$false_answer);
				$this->long_false_answer($data['part4'],$false_answer);
				$this->short_false_answer($data['part5'],$false_answer);
				$this->long_false_answer($data['part6'],$false_answer);
				$this->long_false_answer($data['part7'],$false_answer);

				//luu cau sai
				foreach ($false_answer as  $value) {
					$false_statements = array(
						'id' 		=> "",
						'user_id'	=> $id_user,
						'question_id' => $value
						);
					 $this->query_sql->add('false_statements',$false_statements);
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
			$diemnghe = $this->diemnghe_minitest($socaudungnghe);
			$diemdoc = $this->diemdoc_minitest($socaudungdoc);
			$tongdiem = $diemnghe + $diemdoc ;
			$data['tongdiem'] = $tongdiem;
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
			$data['part7'] = $this->part7();
			// print_r($data['part7']);
			// die;

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
		$data['title'] ='kiểm tra thử';
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
	private function part7($start = "", $limit = "")
	{
		
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>2),0,1);
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>3),0,1);
		$a[] = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'number_question'=>4),0,2);
		
		return $a;
	}


	private function socaudungnghe($part1,$part2,$part3,$part4)
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
	private function socaudungdoc($part5,$part6,$part7)
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
	private function diemnghe_minitest($caudung)
	{
		switch($caudung)
		{
			case 0: $diem =5; break;
			case 1: $diem =5; break;
			case 2: $diem =5; break;
			case 3: $diem =5; break;
			case 4: $diem =5; break;
			case 5: $diem =5; break;
			case 6: $diem =5; break;
			case 7: $diem =5; break;
			case 8: $diem =5; break;
			case 9: $diem =5; break;
			case 10: $diem =5; break;
			case 11: $diem =5; break;
			case 12: $diem =5; break;
			case 13: $diem =5; break;
			case 14: $diem =5; break;
			case 15: $diem =5; break;
			case 16: $diem =10; break;
			case 17: $diem =15; break;
			case 18: $diem =20; break;
			case 19: $diem =25; break;
			case 20: $diem =30; break;
			case 21: $diem =35; break;
			case 22: $diem =40; break;
			case 23: $diem =45; break;
			case 24: $diem =50; break;
			case 25: $diem =60; break;
			case 26: $diem =65; break;
			case 27: $diem =70; break;
			case 28: $diem =80; break;
			case 29: $diem =85; break;
			case 30: $diem =90; break;
			case 31: $diem =95; break;
			case 32: $diem =100; break;
			case 33: $diem =110; break;
			case 34: $diem =115; break;
			case 35: $diem =120; break;
			case 36: $diem =125; break;
			case 37: $diem =130; break;
			case 38: $diem =140; break;
			case 39: $diem =145; break;
			case 40: $diem =150; break;
			case 41: $diem =160; break;
			case 42: $diem =165; break;
			case 43: $diem =170; break;
			case 44: $diem =175; break;
			case 45: $diem =180; break;
			case 46: $diem =190; break;
			case 47: $diem =195; break;
			case 48: $diem =200; break;
			case 49: $diem =210; break;
			case 50: $diem =215; break;
			case 51: $diem =220; break;
			case 52: $diem =225; break;
			case 53: $diem =230; break;
			case 54: $diem =235; break;
			case 55: $diem =240; break;
			case 56: $diem =250; break;
			case 57: $diem =255; break;
			case 58: $diem =260; break;
			case 59: $diem =265; break;
			case 60: $diem =270; break;
			case 61: $diem =280; break;
			case 62: $diem =285; break;
			case 63: $diem =290; break;
			case 64: $diem =300; break;
			case 65: $diem =305; break;
			case 66: $diem =310; break;
			case 67: $diem =320; break;
			case 68: $diem =325; break;
			case 69: $diem =330; break;
			case 70: $diem =335; break;
			case 71: $diem =340; break;
			case 72: $diem =350; break;
			case 73: $diem =355; break;
			case 74: $diem =360; break;
			case 75: $diem =365; break;
			case 76: $diem =370; break;
			case 77: $diem =380; break;
			case 78: $diem =385; break;
			case 79: $diem =390; break;
			case 80: $diem =395; break;
			case 81: $diem =400; break;
			case 82: $diem =405; break;
			case 83: $diem =410; break;
			case 84: $diem =415; break;
			case 85: $diem =420; break;
			case 86: $diem =425; break;
			case 87: $diem =430; break;
			case 88: $diem =435; break;
			case 89: $diem =445; break;
			case 90: $diem =450; break;
			case 91: $diem =455; break;
			case 92: $diem =465; break;
			case 93: $diem =470; break;
			case 94: $diem =480; break;
			case 95: $diem =485; break;
			case 96: $diem =490; break;
			case 97: $diem =495; break;
			case 98: $diem =495; break;
			case 99: $diem =495; break;
			case 100: $diem =495; break;
		}		
		return $diem;
	}
	private function diemdoc_minitest($caudung)
	{
		switch($caudung)
		{
			case 0: $diem = 5; break;
			case 1: $diem = 5; break;
			case 2: $diem = 5; break;
			case 3: $diem = 5; break;
			case 4: $diem = 5; break;
			case 5: $diem = 5; break;
			case 6: $diem = 5; break;
			case 7: $diem = 10; break;
			case 8: $diem = 15; break;
			case 9: $diem = 20; break;
			case 10: $diem = 25; break;
			case 11: $diem = 30; break;
			case 12: $diem = 35; break;
			case 13: $diem = 40; break;
			case 14: $diem = 45; break;
			case 15: $diem = 50; break;
			case 16: $diem = 55; break;
			case 17: $diem = 60; break;
			case 18: $diem = 65; break;
			case 19: $diem = 70; break;
			case 20: $diem = 75; break;
			case 21: $diem = 80; break;
			case 22: $diem = 85; break;
			case 23: $diem = 90; break;
			case 24: $diem = 95; break;
			case 25: $diem = 100; break;
			case 26: $diem = 110; break;
			case 27: $diem = 115; break;
			case 28: $diem = 120; break;
			case 29: $diem = 125; break;
			case 30: $diem = 130; break;
			case 31: $diem = 135; break;
			case 32: $diem = 140; break;
			case 33: $diem = 145; break;
			case 34: $diem = 150; break;
			case 35: $diem = 160; break;
			case 36: $diem = 165; break;
			case 37: $diem = 170; break;
			case 38: $diem = 175; break;
			case 39: $diem = 180; break;
			case 40: $diem = 185; break;
			case 41: $diem = 190; break;
			case 42: $diem = 195; break;
			case 43: $diem = 200; break;
			case 44: $diem = 210; break;
			case 45: $diem = 215; break;
			case 46: $diem = 220; break;
			case 47: $diem = 230; break;
			case 48: $diem = 240; break;
			case 49: $diem = 245; break;
			case 50: $diem = 250; break;
			case 51: $diem = 255; break;
			case 52: $diem = 260; break;
			case 53: $diem = 270; break;
			case 54: $diem = 275; break;
			case 55: $diem = 280; break;
			case 56: $diem = 290; break;
			case 57: $diem = 295; break;
			case 58: $diem = 300; break;
			case 59: $diem = 310; break;
			case 60: $diem = 315; break;
			case 61: $diem = 320; break;
			case 62: $diem = 325; break;
			case 63: $diem = 330; break;
			case 64: $diem = 340; break;
			case 65: $diem = 345; break;
			case 66: $diem = 350; break;
			case 67: $diem = 360; break;
			case 68: $diem = 365; break;
			case 69: $diem = 370; break;
			case 70: $diem = 380; break;
			case 71: $diem = 385; break;
			case 72: $diem = 390; break;
			case 73: $diem = 395; break;
			case 74: $diem = 400; break;
			case 75: $diem = 405; break;
			case 76: $diem = 410; break;
			case 77: $diem = 420; break;
			case 78: $diem = 425; break;
			case 79: $diem = 430; break;
			case 80: $diem = 440; break;
			case 81: $diem = 445; break;
			case 82: $diem = 450; break;
			case 83: $diem = 460; break;
			case 84: $diem = 465; break;
			case 85: $diem = 470; break;
			case 86: $diem = 475; break;
			case 87: $diem = 480; break;
			case 88: $diem = 485; break;
			case 89: $diem = 490; break;
			case 90: $diem = 495; break;
			case 91: $diem = 495; break;
			case 92: $diem = 495; break;
			case 93: $diem = 495; break;
			case 94: $diem = 495; break;
			case 95: $diem = 495; break;
			case 96: $diem = 495; break;
			case 97: $diem = 495; break;
			case 98: $diem = 495; break;
			case 99: $diem = 495; break;
			case 100: $diem = 495; break;
		}
		return $diem;
	}
	
}

/* End of file test.php */
/* Location: ./application/modules/test/controllers/test.php */