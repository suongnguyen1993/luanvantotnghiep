<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fix_test extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->library('Mytest');
	}

	public function index()
	{
		$data['group']['current'] = "fixtest" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['exam'] = $this->query_sql->select_array("exam", "*","",'','');

		$data['template'] = 'fix_test/index';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
	}

	public function fix ($id = null)
	{
		$data['group']['current'] = "fixtest" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['choice'] =$this->query_sql->select_array("choice", "*", "",'','');
		$dethi = $this->query_sql->select_row("exam", "*", array ('id' => $id),'','');

		$id_user = $this->session->userdata('id');
		$data_user = $this->query_sql->select_row('user','level',array('id'=>$id_user));
		if($data_user['level'] == 0)
		{
			$data['error'] = 1;
		}
		$maDeThi = $id;
		$data["audio_exam"] = $dethi['audio'] ;
		
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
			$diemnghe = $this->mytest->diemnghe_fulltest($socaudungnghe);
			$diemdoc = $this->mytest->diemdoc_fulltest($socaudungdoc);
			$tongdiem = $diemnghe + $diemdoc ;
			$data['tongdiem'] = $tongdiem;

			//huy session
			$huysess = array("part5","part6","part7");
			$this->session->unset_userdata($huysess);
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
		$data['title'] ='Đề Thi Toeic';
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
		$result = $this->query_sql->getFixQuesionChoice(array('group_id'=>1,'exam_id'=>$id_exam),$start, $limit);

		return $result;
	}
	private function part2($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixQuesionChoice(array('group_id'=>2,'exam_id'=>$id_exam),$start, $limit);

		return $result;
	}
	private function part3($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixLongQuestion(array('group_id'=>3,'exam_id'=>$id_exam), $start, $limit);
		return $result;
	}
	private function part4($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixLongQuestion(array('group_id'=>4,'exam_id'=>$id_exam), $start,$limit);
		return $result;
	}
	private function part5($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixQuesionChoice(array('group_id'=>5,'exam_id'=>$id_exam), $start, $limit);
		return $result;
	}
	private function part6($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixLongQuestion(array('group_id'=>6,'exam_id'=>$id_exam), $start,$limit);
		return $result;
	}
	private function part7($id_exam = NULL,$start = "", $limit = "")
	{
		$result = $this->query_sql->getFixLongQuestion(array('group_id'=>7,'exam_id'=>$id_exam), $start, $limit);
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