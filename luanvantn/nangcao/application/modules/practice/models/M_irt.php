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
	public function get_1_user($where)
	{
		$sql = "SELECT `id_question`,`trloi` FROM `ma_tran_tra_loi` WHERE `id_user`= ?";

		$query = $this->db->query($sql,array($where));
		return $query->result_array();
	}
	public function get_a_b_20()
	{
		$sql = "SELECT `id`,`do_kho_thuc`,`do_phan_biet` FROM `question` WHERE `group_id` = 5";

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function get_a_b_5()
	{
		$sql = "SELECT `id`,`do_kho_thuc`,`do_phan_biet` FROM `question` WHERE `group_id` = 5 limit 0,6";

		$query = $this->db->query($sql);
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
	public function tong_diem_user_trloi_tatca_CH()
	{
		$query = $this->db->query("SELECT `id_user`, sum(trloi) as dungcauhoi FROM `ma_tran_tra_loi` group by `id_user` ORDER BY `ma_tran_tra_loi`.`id_user` ASC");

		return $query->result_array();
	}

	public function tong_TS ()
	{
		$query = $this->db->query("SELECT id_question,count(`id_user`) as tongts FROM `ma_tran_tra_loi` group by id_question");

		return $query->result_array();
	}
	public function tong_TS_lam_dung_CH()
	{
		$query = $this->db->query("SELECT `id_question`,SUM(`trloi`) as tongdung FROM `ma_tran_tra_loi` WHERE `trloi` = 1 group by `id_question` ORDER BY `ma_tran_tra_loi`.`id_question` ASC");

		return $query->result_array();
	}
	public function tong_diem_user_lam_dung()
	{
		$query = $this->db->query("SELECT `id_user`,SUM(`trloi`) as userlamdung FROM `ma_tran_tra_loi` WHERE `trloi` = 1 group by `id_user`");

		return $query->result_array();
	}
	public function id_question()
	{
		$query = $this->db->query("SELECT distinct id_question FROM `ma_tran_tra_loi` ORDER BY `ma_tran_tra_loi`.`id_question` ASC");

		return $query->result_array();
	}

	public function id_user_trloi_dung_mot_CH($where)
	{
		$sql = "SELECT `id_user` FROM `ma_tran_tra_loi` WHERE `trloi`= 1 and `id_question` = ? ORDER BY `ma_tran_tra_loi`.`id_user` ASC";

		$query = $this->db->query($sql,array($where));
		return $query->result_array();
	}
	public function id_user_trloi_sai_mot_CH($where)
	{
		$sql = "SELECT `id_user` FROM `ma_tran_tra_loi` WHERE `trloi`= 0 and `id_question` = ? ORDER BY `ma_tran_tra_loi`.`id_user` ASC";

		$query = $this->db->query($sql,array($where));
		return $query->result_array();
	}
	public function tong_diem_tat_ca_user()
	{
		
		$query = $this->db->query("SELECT sum(`trloi`) as tongtatcadiemuser FROM `ma_tran_tra_loi`");

		return $query->result_array();

	}
}

/* End of file M_irt.php */
/* Location: ./application/modules/irt/models/M_irt.php */


























