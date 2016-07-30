<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DauVao extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Mytest');
	}
	/*
		# lấy dữ liệu các part từ part1 -> part7 từ csdl lưu lại vào session
		# if có giá trị post xử lý dữ liệu từ session qua hàm addShortUserChoice() và addLongUserChoice()
		
		# $socaudungnghe là tổng câu nghe người dùng làm đúng
		# $socaudungdoc là tổng câu đọc người dùng làm đúng
		# $tongsocaudung tổng số lượng câu người dùng làmđúng
		# tính tổng câu nghe đúng và tổng câu đọc đúng qua hàm socaudungnghe() và socaudocdung()
		# $diemnghe điểm được quy ra ứng với số câu nghe đúng
		# $diemdoc điểm được quy ra ứng với số câu đọc đúng
		# $tongdiem tổng điểm nghe và điểm đọc

		# if $tongdiem <100 thì $diem = 100
		# else $diem = $tongdiem và lưu lại điểm vào cột level của user đó
		# tính tổng điểm qua thư viện "Mytest" 

		@return tổng điểm hiển thị cho người dùng
	*/
	public function index()
	{
		$data['group']['current'] = "dau_vao" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['choice'] =$this->query_sql->select_array("choice", "*", "",'','');
		$id_user = $this->session->userdata('id');

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

			if($data['tongdiem'] < 100)
			{
				$diem = 100;
			}
			else
			{
				$diem = $data['tongdiem'];
			}
			//add level user 
			$diem_dau_vao = array(
							'level'=> $diem
				); 

			$add_level = $this->query_sql->edit('user',$diem_dau_vao, array('id'=>$id_user));
			

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
		$data['template'] = 'dauvao/testtoeic';
		$data['title'] ='kiểm tra thử';
		$data['my_js'] ='frontend/element/foot/my_js/mini_test_js';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
	}
	
	/*
		-Hàm addShortUserChoice() để thêm id choice khi người dùng chọn cho bảng question
		# giá trị $part là dữ liệu part (ví dụ $part1,part2)
		# $data dữ liệu lưu lại giá trị của part
		# $postPart lữ liệu lấy lên khi người dùng submit
		# if không có $postPart trả về mãng rỗng
		# if người dùng có chọn câu trả lời thì gán dữ liệu với key = user_choice và giá trị là $postPart[$part3I][$i]
		(ví dụ: ['user_choice']=>111)
		# if người dùng không chọn giá trị thì gán user_choice = 0

		@return $postPart

	*/
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
	/*
		-Hàm addLongUserChoice() để thêm id choice khi người dùng chọn cho bảnh long_question
		# giá trị $part là dữ liệu part (ví dụ $part1,part2)
		# $data dữ liệu lưu lại giá trị của part
		# $postPart lữ liệu lấy lên khi người dùng submit
		# if không có $postPart trả về mãng rỗng
		# if người dùng có chọn câu trả lời thì gán dữ liệu với key = user_choice và giá trị là $postPart[$part3I][$i]
		(ví dụ: ['user_choice']=>111)
		# if người dùng không chọn giá trị thì gán user_choice = 0

		@return $postPart

	*/
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