<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiem extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Myirt');
		$this->load->model('m_irt');
	}

	public function index()
	{
		$du_lieu = $this->m_irt->get_all();
		foreach ($du_lieu as $key => $value) {
			$P[$value['id']]=$this->myirt->do_kho_thuc($value['level'],$value['the_total_do_correct'],$value['the_total_do']);
		}
		$user = $this->m_irt->get_all_id_user();
		
		foreach ($user as $key => $value) 
		{
			//lay tat ca cau tra loi cua tat ca user
			$trloi[$value['id']] = $this->m_irt->get_all_trloi(array('id_user'=>$value['id']));
			//tao mang level voi key la id user (vd: ['34']=>200,[35]=>400)
			$user_level[$value['id']] = $value['level'];
		}
		// print_r($trloi);
		foreach ($trloi as $key1 => $value1) 
		{
			foreach ($value1 as $key2 => $value2) 
			{
				//mang user tra loi voi key la user id va mang trloi (vd: ['34']=> array([19]=>1,[20]=>0))
				$user_trloi[$key1][$value2['id_question']] = $value2['trloi'];
			}
		}
		print_r($user_trloi);die;
		$a = array();
		foreach ($user_trloi as $k => $v) 
		{

			//xu ly level
			$level_user = $this->myirt->chuyen_level_thanh_ty_so($user_level[$k]);
			if($level_user != 0)
			{
				$level = log($level_user);
			}
			else $level = -2.19;
			//tinh SE
			$SE=$this->myirt->SE($P,$level);

			//kiem tr nguoi dung tr loi dung het hoac sai het
			$tong_trloi = count($v);
			$dem = 0;
			foreach ($v as $e) {
				if($e == 1)
					{$dem +=1;}
			}
			$tong_dung = $dem;
			if($tong_dung ==0 || $tong_dung ==$tong_trloi || $SE >1.5 )
			{
				$theta[$k] = $level;
			}
			else 
				{$theta[$k]=$this->myirt->likelihood($v,$P,$level);}
		}
		// print_r($theta);
		// $limit = (int)(23*0.27);

		// $limit_nhom_gioi = $this->m_irt->limit_nhom_gioi(0,$limit);//27% nhom gioi
		// $limit_nhom_yeu = $this->m_irt->limit_nhom_yeu(0,$limit);//27% nhom yeu
		// foreach ($limit_nhom_gioi as $key => $value) 
		// {
		// 	$id_nhom_gioi[]=$value['id_user'];//lay id nhom gioi
		// }
		// foreach ($limit_nhom_yeu as $key1 => $value1) 
		// {
		// 	$id_nhom_yeu[]=$value1['id_user'];//lay id nhom yeu
		// }
		// $tong_trloi_tung_CH_nhom_gioi = $this->m_irt->tong_dung_nhom_ts_trloi_CH($id_nhom_gioi);//cac cau tra loi nhom gioi ([id]=array(trloi) - vd:[40]=>array([19]=>1,[20]=>0....))
		// $tong_trloi_tung_CH_nhom_yeu = $this->m_irt->tong_dung_nhom_ts_trloi_CH($id_nhom_yeu);//cac cau tra loi nhom yeu
		// $tong_TS_hai_nhom = $limit * 2;

		// foreach ($tong_trloi_tung_CH_nhom_gioi as $gioi) {
		// 	$mang_tong_trloi_tung_CH[$gioi['id_question']]["gioi"] = $gioi['dungcauhoi'];//mang
		// }
		// foreach ($tong_trloi_tung_CH_nhom_yeu as $yeu) {
		// 	$mang_tong_trloi_tung_CH[$yeu['id_question']]['yeu'] = $yeu['dungcauhoi'];
		// }
		// print_r($mang_tong_trloi_tung_CH);
		// foreach ($mang_tong_trloi_tung_CH as $key => $tong) {
		// 	$tyso = ($tong['gioi'] -$tong['yeu'])/$tong_TS_hai_nhom;
		// 	$a[$key] = ($tong['gioi'] -$tong['yeu'])/$tong_TS_hai_nhom;
		// 	// $ty = (1-$tyso)/$tyso;
		// 	$b[$key] = log((1-$tyso)/$tyso);
		// }
		
		// print_r($b);
		// print_r($a);
	}

}

/* End of file kiem.php */
/* Location: ./application/modules/irt/controllers/kiem.php */