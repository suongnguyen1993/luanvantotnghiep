<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$data['group']['current'] = "testtoiec" ;
		$data['group']['current1'] = "test" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');

		$data['part1'] = $this->part1();
		$data['part2'] = $this->part2();
		$data['part3'] = $this->part3();
		$data['part4'] = $this->part4();
		$data['part5'] = $this->part5();
		$data['part6'] = $this->part6();
		// $data['part7'] = $this->part7();

		$data['template'] = 'testtoeic';
		$data['title']='kiểm tra thử';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
	}

	private function part1 ($id = NULL)
	{
		$result = $this->query_sql->getQuesionChoice(array('group_id'=>1,'exam_id'=>18));
		return $result;
	}
	private function part2($id = NULL)
	{
		$result = $this->query_sql->getQuesionChoice(array('group_id'=>2,'exam_id'=>18));
		return $result;
	}
	private function part3($id = NULL)
	{
		$result = $this->query_sql->getLongQuestion(array('group_id'=>3,'exam_id'=>18));
		return $result;
	}
	private function part4($id = NULL)
	{
		$result = $this->query_sql->getLongQuestion(array('group_id'=>4,'exam_id'=>18));
		return $result;
	}
	private function part5($id = NULL)
	{
		$result = $this->query_sql->getQuesionChoice(array('group_id'=>5,'exam_id'=>18));
		return $result;
	}
	private function part6($id = NULL)
	{
		$result = $this->query_sql->getLongQuestion(array('group_id'=>6,'exam_id'=>18));
		return $result;
	}
	


		
		


}

/* End of file test.php */
/* Location: ./application/modules/test/controllers/test.php */