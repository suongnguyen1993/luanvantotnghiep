<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fix_test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index ($id = null)
	{
		$data['group']['current'] = "fulltest" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['choice'] =$this->query_sql->select_array("choice", "*", "",'','');


		if($this->input->post())
		{
			$maDeThi = $this->session->userdata('maDeThi'); 
		}
		else
		{
			if($id != NULL)
			{
				$maDeThi = $id;
			}
			else
			{
				$dethi = $this->query_sql->getRandomExam();
				$maDeThi = $dethi['id'];
				$data["audio_exam"] = $dethi['audio'] ;
			}
		}
		
		//hien thị các part 
		$data['part1'] = $this->part1($maDeThi,0,10);
		$data['part2'] = $this->part2($maDeThi,0,40);
		$data['part3'] = $this->part3($maDeThi,0,10);
		$data['part4'] = $this->part4($maDeThi,0,10);
		
		//end hien thi part
		//xu ly ket qua tra ve
		
		//POST
		if($this->input->post())
		{
			$data['submit'] = 1; 
			$data['part5'] = $this->session->userdata('part5');
			$data['part6'] = $this->session->userdata('part6');
			$data['part7'] = $this->session->userdata('part7');

			$part1 = $this->addShortUserChoice('part1', $data);

			$part2 = $this->addShortUserChoice('part2', $data);
			$part3 = $this->addLongUserChoice('part3', $data);
			$part4 = $this->addLongUserChoice('part4', $data);
			$part5 = $this->addShortUserChoice('part5', $data);
			$part6 = $this->addLongUserChoice('part6', $data);
			$part7 = $this->addLongUserChoice('part7', $data);

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
			$tongdiem = ($diemnghe + $diemdoc)*2 ;
			$data['tongdiem'] = $tongdiem;
		}
		//GET
		else
		{
			
			$data['part5'] = $this->part5($maDeThi,0,40);
			$data['part6'] = $this->part6($maDeThi,0,4);
			$data['part7'] = $this->part7($maDeThi);

			$array = array(
				'part5' => $data['part5'],
				'part6' => $data['part6'],
				'part7' => $data['part7'],
				'maDeThi' => $maDeThi,
			);
			
			$this->session->set_userdata( $array );
		}
		$data['template'] = 'fix_test/testtoeic';
		$data['title'] ='kiểm tra thử';
		$data['my_js'] ='frontend/element/foot/my_js/toeic_js';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
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

	private function part1 ($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getQuesionChoiceNotRandChoice(array('group_id'=>1,'exam_id'=>$id_exam),$start, $limit);

		return $result;
	}
	private function part2($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getQuesionChoiceNotRandChoice(array('group_id'=>2,'exam_id'=> $id_exam),$start, $limit);

		return $result;
	}
	private function part3($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getLongQuestion(array('group_id'=>3,'exam_id'=>$id_exam), $start, $limit);
		return $result;
	}
	private function part4($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getLongQuestion(array('group_id'=>4,'exam_id'=>$id_exam), $start,$limit);
		return $result;
	}
	private function part5($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getQuesionChoiceRandom(array('group_id'=>5,'exam_id'=> $id_exam), $start, $limit);
		return $result;
	}
	private function part6($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getLongQuestionRandom(array('group_id'=>6,'exam_id'=>$id_exam), $start,$limit);
		return $result;
	}
	private function part7($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getRandLongQuestion_Question(array('group_id'=>7,'exam_id'=>$id_exam), $start, $limit);
		return $result;
	
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

					$answer = $this->query_sql->select_row("choice","correct_answer",array('id'=>$id),'');
					
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
			case 4: $diem =10; break;
			case 5: $diem =15; break;
			case 6: $diem =20; break;
			case 7: $diem =25; break;
			case 8: $diem =30; break;
			case 9: $diem =35; break;
			case 10: $diem = 40; break;
			case 11: $diem =45; break;
			case 12: $diem =50; break;
			case 13: $diem =55; break;
			case 14: $diem =60; break;
			case 15: $diem =65; break;
			case 16: $diem =72.5; break;
			case 17: $diem =77.5; break;
			case 18: $diem =82.5; break;
			case 19: $diem =87.5; break;
			case 20: $diem =92.5; break;
			case 21: $diem =97.5; break;
			case 22: $diem =10.5; break;
			case 23: $diem =115; break;
			case 24: $diem =120; break;
			case 25: $diem =125; break;
			case 26: $diem =130; break;
			case 27: $diem =135; break;
			case 28: $diem =140; break;
			case 29: $diem =147.5; break;
			case 30: $diem =152.5; break;
			case 31: $diem =157.5; break;
			case 32: $diem =162.5; break;
			case 33: $diem =167.5; break;
			case 34: $diem =172.5; break;
			case 35: $diem =180; break;
			case 36: $diem =185; break;
			case 37: $diem =190; break;
			case 38: $diem =197.5; break;
			case 39: $diem =202.5; break;
			case 40: $diem =210; break;
			case 41: $diem =215; break;
			case 42: $diem =220; break;
			case 43: $diem = 225; break;
			case 44: $diem =232.5; break;
			case 45: $diem =237.5; break;
			case 46: $diem =242.5; break;
			case 47: $diem =247.5; break;
			case 48: $diem =247.5; break;
			case 49: $diem =247.5; break;
			case 50: $diem =247.5; break;
			
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
			case 5: $diem = 10; break;
			case 6: $diem = 15; break;
			case 7: $diem = 20; break;
			case 8: $diem = 25; break;
			case 9: $diem = 30; break;
			case 10: $diem = 35; break;
			case 11: $diem = 40; break;
			case 12: $diem = 45; break;
			case 13: $diem = 52.5; break;
			case 14: $diem = 60; break;
			case 15: $diem = 65; break;
			case 16: $diem = 70; break;
			case 17: $diem = 75; break;
			case 18: $diem = 80; break;
			case 19: $diem = 85; break;
			case 20: $diem = 92.5; break;
			case 21: $diem = 97.5; break;
			case 22: $diem = 105; break;
			case 23: $diem = 110; break;
			case 24: $diem = 117.5; break;
			case 25: $diem = 122.5; break;
			case 26: $diem = 132.5; break;
			case 27: $diem = 137.5; break;
			case 28: $diem = 145; break;
			case 29: $diem = 150; break;
			case 30: $diem = 155; break;
			case 31: $diem = 160; break;
			case 32: $diem = 167.5; break;
			case 33: $diem = 172.5; break;
			case 34: $diem = 177.5; break;
			case 35: $diem = 182.5; break;
			case 36: $diem = 187.5; break;
			case 37: $diem = 192.5; break;
			case 38: $diem = 197.5; break;
			case 39: $diem = 202.5; break;
			case 40: $diem = 207.5; break;
			case 41: $diem = 210; break;
			case 42: $diem = 215; break;
			case 43: $diem = 220; break;
			case 44: $diem = 225; break;
			case 45: $diem = 232.5; break;
			case 46: $diem = 237.5; break;
			case 47: $diem = 245; break;
			case 48: $diem = 247.5; break;
			case 49: $diem = 247.5; break;
			case 50: $diem = 247.5; break;
			
		}
		return $diem;
	}

}

/* End of file test.php */
/* Location: ./application/modules/test/controllers/test.php */