<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Myirt');
	}
	public function index()
	{

		$dokho = array(-0.81,2.5,-0.81,-0.78,-1.21,0.17,0.52,0.76,-0.94,-0.21,-0.78,0.2,-0.07,-0.68,0.96,-0.81,-0.11,-0.42);
		$trloi = array(0,0,1,1,1);
		$theta = -2.19;
		// $a = $this->myirt->SE($dokho,$theta);
		// echo $a;

		$this->myirt->likelihood($trloi,$dokho,$theta);
	}



	public function do_kho_khao_sat($tong_nguoi_lam_dung,$tong_ng_lam)
	{
		$b =$tong_nguoi_lam_dung/$tong_ng_lam;
		return $b;
	}

	public function chuyen_level_thanh_ty_so($level)
	{
		$b = $level/990;

		return $b;
	}

	public function do_kho_thuc($level,$tong_nguoi_lam_dung,$tong_ng_lam)
	{
			$dokho = $this->chuyen_level_thanh_ty_so($level);
			$do_kho_ban_dau = log($dokho);

			$xac_xuat_do_kho = $tong_nguoi_lam_dung/$tong_ng_lam;

			$ln_xac_xuat_do_kho = log((1-$xac_xuat_do_kho)/$xac_xuat_do_kho);
			$b = ($do_kho_ban_dau * 0.2) + ($ln_xac_xuat_do_kho * 0.8);

			// $P = log(($b/(1-$b)));
			return $b;
			// return $P;
			
	}

	public function xac_suat_p($nangluc,$do_kho_thuc)
	{
		$b = $do_kho_thuc;
		$O = $nangluc;

		$P = exp($O - $b)/(1+exp($O - $b));
		// $ln_P = log($P/(1-$P));
		return $ln_P;
	}

	public function likelihood($array_tra_loi,$array_do_kho,$theta)
	{

		do
		{
			$t1=0;$t2=0;$ketqua = 0;$c = 0;

			for($i=0;$i<count($array_tra_loi);$i++)
			{
				//print_r($array_do_kho);

				// die;
				//echo'theta 1:'.$theta; echo '  '.$array_do_kho[$i];
				$a = exp(-($theta-$array_do_kho[$i]));
				//echo 'mu:'.$a;
				$p=1/(1+$a);
				// echo ' P'.$p;
				// die;
				//echo'mu:'.exp(-($theta-$array_do_kho[$i]));
				$q=1-$p;

				$t1+=($array_tra_loi[$i]-$p);
				$t2+=$p*$q;

				
			}
			$delta = $t1/$t2;
			$c=$theta;
			echo "se= ".(1/sqrt($t2))." - ";

			echo "p: ".($p).'<br>';
			echo "q: ".($q).'<br>';
			echo "t1: ".($t1).'<br>';
			echo "t2: ".($t2).'<br>';

			$kq=$theta+$t1/$t2;
			$theta=$kq;
			echo "delta: ".(abs($kq-$c)).'~~'.$delta.'<br>';


		}while(abs($kq-$c)>0.001);

		echo 'theta'. $theta;
		 //return $theta;
		//echo "xong";
	}

	public function SE($array_do_kho,$theta)
	{
		$SE = 0;
		$mau = 0;
		for($i = 0; $i<count($array_do_kho);$i++)
		{
			$P = exp($theta - $array_do_kho["$i"])/(1+exp($theta - $array_do_kho["$i"]));
			$Q = 1-$P;
			$mau += $P*$Q;
		}

		$SE = (1/sqrt($mau));
		return $SE;
		
	}
	public function ham_thong_tin_cau_hoi($nang_luc,$do_kho_thuc)
	{
		$I = 2.89/(exp(1.7*($nang_luc-$do_kho_thuc))*pow((1+exp(-1.7*($nang_luc-$do_kho_thuc))),2));
		return $I;
	}



}

/* End of file abc.php */
/* Location: ./application/modules/irt/controllers/abc.php */