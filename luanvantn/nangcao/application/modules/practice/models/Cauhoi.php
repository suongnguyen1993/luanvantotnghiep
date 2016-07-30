<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cauhoi extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/* viet ham su dung bien where*/
	//lay long_question va question thuoc long_question
	
	public function getLongQuestion($where = "" ,$vt=-1,$limit=-1)
	
		{	
		
			//lay long_question
			$query = $this->db->select('*');//lay thong tin sua lai o day
			$this->db->order_by('id','RANDOM');
			$this->db->limit(4);
			
			if($where!='')
			{
				$result = $this->db->where($where);
				
			}
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('long_question', $limit, $vt);
				
			}
			else
			{
				$query = $this->db->get('long_question');
			}
			//da lay duoc long_question
			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				//goi lai ham question truyen vao id cua long_question de lay cau hoi va cau tra loi thuoc cau hoi do
				$question=$this->getQuestionChoice(array("id_long_question"=>$long_question[$i]['id']));
				
				$long_question[$i]['question']=$question;
				
			}
			return $long_question;
			
		}
	//lay cau hoi la cau tra loi cua cau hoi
	public function getQuestionChoice($where = "",$vt=-1,$limit=-1)
	{
		
		$query = $this->db->select('id, content, image, audio, id_long_question')->where($where);//o day nua lay cai can thiet thoi
		
		if($vt>=0 && $limit > 0)
		{
			
			$query = $this->db->get('question', $limit, $vt);
			
		}
		
		$query = $this->db->get('question');

		
		$ch=$query->result_array();
		
		for($i=0;$i<count($ch);$i++)
		{
			
			$this->db->order_by('id','RANDOM');
			$tl=$this->getAnswer($ch[$i]['id']);
			
			$ch[$i]['traloi']=$tl;
			
		}
		return $ch;
	}
	
	public function getlistening($where = "")
	{
		
		$query = $this->db->select('*')->where($where);//o day nua lay cai can thiet thoi
		$this->db->order_by('id','RANDOM');
		$this->db->limit(10,0);
		
			$query = $this->db->get('question');
		
		$ch=$query->result_array();
		
		for($i=0;$i<count($ch);$i++)
		{
			
			
			$tl=$this->getAnswer($ch[$i]['id']);
			
			$ch[$i]['traloi']=$tl;
			
		}
		return $ch;
	}
	
	public function getreading($where = "")
	{
		
		$query = $this->db->select('*')->where($where);//o day nua lay cai can thiet thoi
		$this->db->order_by('id','RANDOM');
		$this->db->limit(24);
		// $sql = "SELECT * FROM `question` WHERE `group_id`=5 ORDER BY `question`.`do_kho_thuc` DESC limit 0,20";
		// $sql = "SELECT * FROM `question` join tam on question.id = tam.id_question where tam.id_user = ? ORDER BY `tam`.`thong_tin` DESC limit 0,15";
		// $query = $this->db->query($sql,array(30));

		// $ch=$query->result_array();
		// if($vt>=0 && $limit > 0)
		// {
			
		// 	$query = $this->db->get('question', $limit, $vt);
			
		// }
		
		$query = $this->db->get('question');
		$ch=$query->result_array();
		
		for($i=0;$i<count($ch);$i++)
		{
			
			$this->db->order_by('id','RANDOM');
			$tl=$this->getAnswer($ch[$i]['id']);
			
			$ch[$i]['traloi']=$tl;
			
		}
		return $ch;

	}
	public function getreading_irt($where = "")
	{
		
		// $query = $this->db->select('*')->where($where);//o day nua lay cai can thiet thoi
		// $this->db->order_by('id','RANDOM');
		// $this->db->limit(24);
		// $sql = "SELECT * FROM `question` WHERE `group_id`=5 ORDER BY `question`.`do_kho_thuc` DESC limit 0,20";
		$sql = "SELECT * FROM `question` join tam on question.id = tam.id_question where tam.id_user = ? ORDER BY `tam`.`thong_tin` DESC limit 0,6";
		$query = $this->db->query($sql,array($where));

		$ch=$query->result_array();
		// if($vt>=0 && $limit > 0)
		// {
			
		// 	$query = $this->db->get('question', $limit, $vt);
			
		// }
		
		// $query = $this->db->get('question');
		$ch=$query->result_array();
		
		for($i=0;$i<count($ch);$i++)
		{
			
			$this->db->order_by('id','RANDOM');
			$tl=$this->getAnswer($ch[$i]['id']);
			
			$ch[$i]['traloi']=$tl;
			
		}
		return $ch;

	}
	
	public function getAnswer($id)
		{
			$query = $this->db->select('id,content,correct_answer,question_id')->where('question_id',$id)->get('choice');
			
			
			return $query->result_array();
		}
	
	/*end*/
	
	public function addfalsestatement($table = '', $data = NULL)
		{
			$query = $this->db->insert($table, $data);
			$flag = $this->db->affected_rows();
			if($flag > 0){
				return 1;
			}
			else
			{
				return 0;
			}
		}
	
	function select_row($table = '', $data = NULL, $where = NULL, $order = ''){
			$result = $this->db->select($data)->from($table);
			if($where!=''){
				$result = $this->db->where($where);
			}
			if($order!=''){
				$result = $this->db->order_by($order);
			}
			$result = $this->db->get()->row_array();
			return $result;
		}
	
		function edit($table = '', $data = NULL, $where = NULL){
			$query = $this->db->where($where)->update($table, $data);
			$flag = $this->db->affected_rows();
			if($flag > 0){
				return array(
					'type'		=> 'Successful',
					'message'	=> 'Update successful data!'				
				);
			}
			else
			{
				return array(
					'type'		=> 'Error',
					'message'	=> 'Update data failed!',
				);
			}
		}

		function add($table = '', $data = NULL){
			$query = $this->db->insert($table, $data);
			$flag = $this->db->affected_rows();
			if($flag > 0){
				return 1;
			}
			else
			{
				return 0;
			}
		}
}

/* End of file Cauhoi.php */
/* Location: ./application/models/Cauhoi.php */




































