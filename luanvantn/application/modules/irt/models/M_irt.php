<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_irt extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Myirt');
	}

	public function get_all()
	{
		$query = $this->db->query("SELECT * FROM `question` WHERE `id`IN (select id_question from ma_tran_tra_loi ) ORDER BY `question`.`id` ASC");

		return $query->result_array();
	}

	public function get_all_id_user()
	{
		$query = $this->db->query('select id,level from `user` where id IN( SELECT `id_user` FROM `ma_tran_tra_loi` WHERE `id_user` group by id_user)');
		return $query->result_array();
	}
	public function get_all_trloi($where = NULL)
	{
		
			$result = $this->db->select('id_question,trloi')->from("ma_tran_tra_loi")->order_by('id_question','asc');
			if($where!=''){
				$result = $this->db->where($where);
			}
			//$this->db->order_by('id_user', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;		
	}
	public function limit_nhom_gioi($start,$limit)
	{
		$sql = "SELECT `id_user`,SUM(`trloi`) as tongdung FROM `ma_tran_tra_loi` WHERE `trloi` = 1 group by `id_user` ORDER BY `tongdung` DESC limit $start,$limit ";
		$query = $this->db->query($sql);
		return $query->result_array();

	}
	public function limit_nhom_yeu($start,$limit)
	{
		$sql = "SELECT `id_user`,SUM(`trloi`) as tongdung FROM `ma_tran_tra_loi` WHERE `trloi` = 1 group by `id_user` ORDER BY `tongdung` ASC limit $start,$limit ";
		$query = $this->db->query($sql);
		return $query->result_array();

	}
	public function tong_dung_nhom_ts_trloi_CH($where)
	{
		$sql = "SELECT `id_question`, sum(trloi) as dungcauhoi FROM `ma_tran_tra_loi` where id_user in ? group by `id_question`";

		$query = $this->db->query($sql,array($where));
		return $query->result_array();
	}

}

/* End of file M_irt.php */
/* Location: ./application/modules/irt/models/M_irt.php */