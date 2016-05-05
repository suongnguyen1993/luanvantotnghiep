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
				$this->db->select_max('id');
				$max_id = $this->db->get($table)->row_array();
				return array(
					'type'		=> 'Successful',
					'message'	=> 'Adding successful data!',
					'id'		=> $max_id		
				);
			}
			else
			{
				return array(
					'type'		=> 'Error',
					'message'	=> 'Adding data failed!',
				);
			}
		}

		function add_exam($table = '', $data = NULL){
			$query = $this->db->insert($table, $data);
			$flag = $this->db->affected_rows();
			if($flag > 0){
			
				$max_id = $this->db->get($table)->row_array();
				return array(
					'type'		=> 'Successful',
					'message'	=> 'Adding successful data!',
						
				);
			}
			else
			{
				return array(
					'type'		=> 'Error',
					'message'	=> 'Adding data failed!',
				);
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

		function select_array($table = '', $data = NULL, $where = NULL, $order = '', $like = NULL){
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
		function view($select="", $table="", $start=NULL, $limit=NULL){

			return $this->db->select($select)->from($table)->order_by('id desc')->limit($limit, $start)->get()->result_array();
		}
		function view_where($select, $table, $where, $start, $limit){
			return $this->db->select($select)->from($table)->order_by('id desc')->where($where)->limit($limit, $start)->get()->result_array();
		}
		function _pagination()
		{
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next &raquo;';
			$config['next_tag_open'] = '<li class="paginate_button next">';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = '&laquo; Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a class="number current">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			$config['num_links'] = 5;
			$config['uri_segment'] = 3;
			
			$config['use_page_numbers'] = TRUE;
			$config['per_page'] = 10;
			return $config;
		}
		
		function check_maxid($table = ''){
			$results = $this->db->select_max('id')->from($table)->get()->row_array();
			$data = $results['id'] + 1;
			return $data;
		}
	}
?>