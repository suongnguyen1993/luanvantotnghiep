<?php
	class Query_sql extends CI_Model{
		function __construct()
		{
			parent::__construct();

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
		function del($table = '', $where = NULL){
			$this->db->delete($table, $where); 
			$flag = $this->db->affected_rows();
			if($flag > 0){
				return array(
					'type'		=> 'Successful',
					'message'	=> 'Deleting successful data!'
				);
			}
			else
			{
				return array(
					'type'		=> 'Error',
					'message'	=> 'Deleting data failed!'
				);
			}
		}
		
		public function getFixLongQuestion($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getFixQuesionChoice(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;
		}
		public function getFixQuesionChoice($where = "" ,$vt=-1,$limit=-1)

		{
			$query = $this->db->select('*');

			if($where!='')
			{
				$result = $this->db->where($where);

			}
			
			
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('question', $limit, $vt);
			}
			else
			{
				$query = $this->db->get('question');
			}
			//echo $this->db->last_query();
			//echo '<br>';
			
			$ch=$query->result_array();
			for($i=0;$i<count($ch);$i++)
			{
				$tl=$this->getAnswer($ch[$i]['id']);
				$ch[$i]['choice']=$tl;
				
			}
			
			return $ch;
		}

		/*
			lấy long_question có question không random và choice random
		*/
		public function getLongQuestion($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getQuesionChoice(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;
		}

		/*
			lấy question không random và choice random
		*/
		public function getQuesionChoice($where = "" ,$vt=-1,$limit=-1)

		{
			$query = $this->db->select('*');

			if($where!='')
			{
				$result = $this->db->where($where);

			}
			
			
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('question', $limit, $vt);
			}
			else
			{
				$query = $this->db->get('question');
			}
			//echo $this->db->last_query();
			//echo '<br>';
			
			$ch=$query->result_array();
			for($i=0;$i<count($ch);$i++)
			{
				$tl=$this->getRanAnswer($ch[$i]['id']);
				$ch[$i]['choice']=$tl;
				
			}
			
			return $ch;
		}
		/*
			lấy question random và choice không random
		*/
		public function getRandomQuesion_ChoiceNotRandChoice($where = "" ,$vt=-1,$limit=-1)

		{
			$query = $this->db->select('*')->order_by('id','RANDOM');

			if($where!='')
			{
				$result = $this->db->where($where);

			}
			
			
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('question', $limit, $vt);
			}
			else
			{
				$query = $this->db->get('question');
			}
			//echo $this->db->last_query();
			//echo '<br>';
			
			$ch=$query->result_array();
			for($i=0;$i<count($ch);$i++)
			{
				$tl=$this->getAnswer($ch[$i]['id']);
				$ch[$i]['choice']=$tl;
				
			}
			
			return $ch;
		}
		/*
			lấy question không random và choice không random
		*/
		public function getQuesionChoiceNotRandChoice($where = "" ,$vt=-1,$limit=-1)

		{
			$query = $this->db->select('*');

			if($where!='')
			{
				$result = $this->db->where($where);

			}
			
			
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('question', $limit, $vt);
			}
			else
			{
				$query = $this->db->get('question');
			}
			//echo $this->db->last_query();
			//echo '<br>';
			
			$ch=$query->result_array();
			for($i=0;$i<count($ch);$i++)
			{
				$tl=$this->getAnswer($ch[$i]['id']);
				$ch[$i]['choice']=$tl;
				
			}
			
			return $ch;
		}
		/*
			lấy Long_question random và choice không random
		*/
		public function getRandomLong_QuestionRandom($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*')->order_by('id','RANDOM');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getQuesionChoiceRandom(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;
		}
		public function getLongQuestionRandom($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*')->order_by('id','RANDOM');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getQuesionChoice(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;
		}

		public function getLongQuestionRandomQuestion($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getQuesionChoiceRandom(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;


		}

		public function getRandLongQuestion_Question($where = "" ,$vt=-1,$limit=-1)
		{	
			$query = $this->db->select('*')->order_by('id','RANDOM');
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
			//echo $this->db->last_query();
			//echo '<br>';

			$long_question =$query->result_array();
			for($i=0;$i<count($long_question);$i++)
			{
				
				$question=$this->getQuesionChoiceRandom(array("id_long_question"=>$long_question[$i]['id']));
				$long_question[$i]['question']=$question;
				 
			}
			return $long_question;


		}

		public function getQuesionChoiceRandom($where = "" ,$vt=-1,$limit=-1)

		{
			$query = $this->db->select('*')->order_by('id','RANDOM');

			if($where!='')
			{
				$result = $this->db->where($where);

			}
			
			
			if($vt>=0 && $limit > 0)
			{
				$query = $this->db->get('question', $limit, $vt);
			}
			else
			{
				$query = $this->db->get('question');
			}
			//echo $this->db->last_query();
			//echo '<br>';
			
			$ch=$query->result_array();
			for($i=0;$i<count($ch);$i++)
			{
				$tl=$this->getRanAnswer($ch[$i]['id']);
				$ch[$i]['choice']=$tl;
				
			}
			
			return $ch;
		}

		public function getAnswer($id)
		{
			$query = $this->db->select('id,content,correct_answer,question_id')->where('question_id',$id)->get('choice');
			return $query->result_array();
		}
		public function getRanAnswer($id)
		{
			$query = $this->db->select('id,content,correct_answer,question_id')->where('question_id',$id)->order_by('id',"RANDOM")->get('choice');
			return $query->result_array();
		}
		public function select_array($table = '', $data = NULL, $where = NULL, $order = '', $like = NULL){
			$result = $this->db->select($data)->from($table);
			if($where!=''){
				$result = $this->db->where($where);
			}
			if($like!=''){
				$result = $this->db->like($like);
			}
			if($order!=''){
				$result = $this->db->order_by($order);
			}
			$result = $this->db->get()->result_array();
			return $result;
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
		function select_join ($data = NULL, $table = '', $table_join = '', $where = '',$option = "")
		{
			$this->db->select($data);
			$this->db->from($table);
			$this->db->join($table_join, $where ,$option);
			$result = $this->db->get()->row_array();
			return $result;
		}
		function total($table){
			return $this->db->from($table)->count_all_results();
		}
		function total_where($table,$where){
			return $this->db->from($table)->where($where)->count_all_results();
		}
		function getRandomExam(){

			$query = $this->db
			->query("SELECT ex.id, ex.audio

					FROM `exam` ex  

					WHERE exists(select * from question where exam_id = ex.id)

					ORDER BY Rand()

					Limit 1");

  			$row = $query->row_array();

  			return $row;
  			/*print_r($row->id);
  			die;

			return $this->db->select($select)
			->from($table)
			->order_by('id','RANDOM')
			->limit($limit, $start)
			->get()->result_array();*/
		}
		function view_where($select, $table, $where, $start, $limit){
			return $this->db->select($select)->from($table)->order_by('id desc')->where($where)->limit($limit, $start)->get()->result_array();
		}
		function check_maxid($table = ''){
			$results = $this->db->select_max('id')->from($table)->get()->row_array();
			$data = $results['id'] + 1;
			return $data;
		}
	}
?>