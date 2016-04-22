<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_exam extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 1)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		$data['title'] = 'Manage Content exam';
		$data['error'] = $this->session->flashdata('noice');
		if($this->input->post())
		{
			$search = $this->input->post("search");
			$data['exam'] = $this->query_sql
			->select_array("exam","*","","",array("info" =>"$search"));
		}
		else
		{
			
			$this->load->library('pagination');
			$config = $this->query_sql->_pagination();
			$config['base_url'] = base_url().'admin/exam/index/';
			$config['total_rows'] = $this->query_sql->total('exam');
			$config['uri_segment'] = 4;
			$total_page = ceil($config['total_rows']/$config['per_page']);
			$page = ($page > $total_page)?$total_page:$page;
			$page = (!isset($page) | $page <= 1)?1:$page;

			$this->pagination->initialize($config);
			$data['list_pagination'] = $this->pagination->create_links();

			$data['exam']= $this->query_sql
			->view('*',"exam",($page-1)*$config['per_page'],$config['per_page']);
		}
		$data['template']='backend/content_exam/index';
		$this->load->view('backend/layout/admin',$data);
	}
	public function update($id)
	{
		if($this->check_login() == false)
		{
			redirect('admin/login');
		}
		

		$data['exam'] =$this->query_sql->select_row('exam','*',array ('id'=>$id),'') ;
		$name_exam = $data['exam']['name'];
		$data['title'] = "Manage Content exam $name_exam";
		$data['question_part1'] = $this->part1($id);
		$count1 = $this->query_sql->total_where('question',array ('group_id' => 1, 'exam_id'=>$id)) ;
		if( $count1 >= 10)
		{
			$data['show1'] = 'style="display: none;"';
		}
		$data['question_part2'] = $this->part2($id);
		$count2 = $this->query_sql->total_where('question',array ('group_id' => 2, 'exam_id'=>$id));
		if( $count2 >= 30)
		{
			$data['show2'] = 'style="display: none;"';
		}
		
		$data['question_part3'] = $this->part3($id);
		$count3 = $this->query_sql->total_where('long_question',array ('group_id' => 3, 'exam_id'=>$id));
		if( $count3 >= 10)
		{
			$data['show3'] = 'style="display: none;"';
		}	
		$data['question_part4'] = $this->part4($id);
		$count4 = $this->query_sql->total_where('long_question',array ('group_id' => 4, 'exam_id'=>$id));
		if( $count4 >= 10)
		{
			$data['show4'] = 'style="display: none;"';
		}	
		$data['question_part5'] = $this->part5($id);
		$data['question_part6'] = $this->part6($id);
		$data['question_part7'] = $this->part7($id);

		$data['template']='backend/content_exam/edit';
		$this->load->view('backend/layout/admin',$data);

	}

		public function check_login ()
	{
		if($this->session->has_userdata('username'))
			return true;
		else return false;
	}
	//-------------------------------------------

	private function part1($id)
	{
		 $result=$this->query_sql->select_array('question','*',array ('group_id' => 1, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part2($id)
	{
		 $result=$this->query_sql->select_array('question','*',array ('group_id' => 2, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part3($id)
	{
		 $result=$this->query_sql->select_array('long_question','*',array ('group_id' => 3, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part4($id)
	{
		 $result=$this->query_sql->select_array('long_question','*',array ('group_id' => 4, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part5($id)
	{
		 $result=$this->query_sql->select_array('question','*',array ('group_id' => 5, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part6($id)
	{
		 $result=$this->query_sql->select_array('question','*',array ('group_id' => 6, 'exam_id'=>$id),'',"") ;
		return $result;
	}
	private function part7($id)
	{
		 $result=$this->query_sql->select_array('question','*',array ('group_id' => 7, 'exam_id'=>$id),'',"") ;
		return $result;
	}


}

/* End of file Content_exam.php */
/* Location: ./application/controllers/admin/Content_exam.php */