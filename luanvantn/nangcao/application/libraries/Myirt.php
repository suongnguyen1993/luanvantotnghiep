<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myirt
{
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

	public function chuyen_ln_thanh_level($level_ln)
	{
		$level = (exp($level_ln)/(1+(exp($level_ln))))*990;
		return $level;
	}

	public function do_kho_thuc($level,$tong_nguoi_lam_dung,$tong_ng_lam)
	{
		$dokho = $this->chuyen_level_thanh_ty_so($level);
		if($dokho != 0)
		{
			$do_kho_ban_dau = log($dokho);
		}
		else $do_kho_ban_dau = 0;
		if($tong_nguoi_lam_dung == 0 || $tong_ng_lam == 0)
		{
			$xac_xuat_do_kho = 0.5;
		}
		else $xac_xuat_do_kho = $tong_nguoi_lam_dung/$tong_ng_lam;

		$ln_xac_xuat_do_kho = log((1-$xac_xuat_do_kho)/$xac_xuat_do_kho);

		$b = ($do_kho_ban_dau * 0.2) + ($ln_xac_xuat_do_kho * 0.8);

		return $b;
			
	}

	public function do_phan_biet($array_TB_lam_dung,$array_TB_lam_sai,$sn,$so_SV_lam_dung,$so_SV_lam_sai,$tong_so_SV)
	{
		$tong_sv_lam_dung_CH = 0; $tong_sv_lam_sai_CH = 0;
		foreach ($array_TB_lam_dung as  $value) 
		{
			$tong_sv_lam_dung_CH +=  $value;
		}
		foreach ($array_TB_lam_sai as  $value) 
		{
			$tong_sv_lam_sai_CH +=  $value;
		}
		$TB_sv_lam_dung_CH = $tong_sv_lam_dung_CH/$so_SV_lam_dung;
		$TB_sv_lam_sai_CH = $tong_sv_lam_sai_CH/$so_SV_lam_sai;

		$m = ($TB_sv_lam_dung_CH - $TB_sv_lam_sai_CH)/$sn;
		$n = sqrt(($so_SV_lam_dung*$so_SV_lam_sai)/pow($tong_so_SV,2));

		$a = $m * $n;
		return $a; 
	}
	public function SN($tong_so_SV,$array_diem_SV,$diem_tb_SV)
	{
		$tongdiemuserlamdung = 0;
		
		foreach ($array_diem_SV as $key => $value) 
		{
			$tongdiemuserlamdung += pow(($array_diem_SV[$key] - $diem_tb_SV),2);
		}
		$sn = sqrt($tongdiemuserlamdung/$tong_so_SV);

		return $sn;
	}
	public function SE_1_tham_so($array_do_kho,$theta)
	{
		$SE = 0;
		$mau = 0;
		foreach ($array_do_kho as $key => $value)
		{
			$P = exp(($theta - $array_do_kho["$key"]))/(1+exp(($theta - $array_do_kho["$key"])));
			$Q = 1-$P;
			$mau += $P*$Q;
		}

		$SE = (1/sqrt($mau));
		return $SE;
		
	}
	public function xac_suat_p_1_tham_so($nangluc,$do_kho_thuc)
	{
		$b = $do_kho_thuc;
		$O = $nangluc;

		$P = exp(($O - $b))/(1+exp(($O - $b)));
		return $P;
	}
	public function likelihood_1_tham_so($array_tra_loi,$array_do_kho,$theta)
	{
		do
		{
			$t1=0;$t2=0;
			// echo 'thetadb '.$theta;
			foreach ($array_tra_loi as $key => $value)
			{
				// $p = round(1/(1+exp(-($array_do_phan_biet[$key]*($theta-$array_do_kho[$key])))),2);
				$p = round($this->xac_suat_p_1_tham_so($theta,$array_do_kho[$key]),2);
				$q=round(1-$p,3);

				$t1+=round(($array_tra_loi[$key]-$p),3);
				$t2+=round($p*$q,3);
				// echo 'u: '.$array_tra_loi[$key].' ';
				// echo 'P: '.$p.' ';
				// echo 'Q: '.$q.' ';
				// echo 'a: '.$array_do_phan_biet[$key].' ';
				// echo "a(u-P)".round($array_do_phan_biet[$key]*($array_tra_loi[$key]-$p),3).' ';
				// echo 'a*a(PQ): '.round(pow($array_do_phan_biet[$key],2)*$p*$q,3).'<br>';


			}
			// echo 'sum a(u-P): '.$t1.'<br>';
			// echo 'sum a*a(PQ): '.$t2.'<br>';
			$c=$theta;
			$kq=$theta+$t1/$t2;
			$theta=$kq; 
			// echo 'delta năng lực'.$t1/$t2.'~~';
			// echo 'năng lực: '.$theta.'<br>';

		}while(abs($kq-$c)>0.01);
		// echo'xong'.'<br>';
		$se = 1/sqrt($t2);
		// echo 'sai số chuẩn SE'.$se.'<br>';
		return $theta;
	}
	public function ham_thong_tin_cau_hoi_1_tham_so($nang_luc,$do_kho_thuc)
	{
		$level_user = $this->chuyen_level_thanh_ty_so($nang_luc);
		if($level_user != 0)
		{
			$nang_luc = log($level_user/(1-$level_user));
		}
		$I = 2.89/(exp(1.7*($nang_luc-$do_kho_thuc))*pow((1+exp(-1.7*($nang_luc-$do_kho_thuc))),2));
		return $I;
	}
		public function xac_suat_p($nangluc,$do_kho_thuc,$do_phan_biet)
	{
		$b = $do_kho_thuc;
		$O = $nangluc;

		$P = exp($do_phan_biet * ($O - $b))/(1+exp($do_phan_biet*($O - $b)));
		return $P;
	}
	public function likelihood($array_tra_loi,$array_do_kho,$array_do_phan_biet,$theta)
	{
		do
		{
			$t1=0;$t2=0;
			// echo 'thetadb '.$theta;
			foreach ($array_tra_loi as $key => $value)
			{
				// $p = round(1/(1+exp(-($array_do_phan_biet[$key]*($theta-$array_do_kho[$key])))),2);
				$p = round($this->xac_suat_p($theta,$array_do_kho[$key],$array_do_phan_biet[$key]),2);
				$q=round(1-$p,3);

				$t1+=round($array_do_phan_biet[$key]*($array_tra_loi[$key]-$p),3);
				$t2+=round(pow($array_do_phan_biet[$key],2)*$p*$q,3);
				// echo 'u: '.$array_tra_loi[$key].' ';
				// echo 'P: '.$p.' ';
				// echo 'Q: '.$q.' ';
				// echo 'a: '.$array_do_phan_biet[$key].' ';
				// echo'SE:'.$t2.'~~';
				// echo "a(u-P)".round($array_do_phan_biet[$key]*($array_tra_loi[$key]-$p),3).' ';
				// echo 'a*a(PQ): '.round(pow($array_do_phan_biet[$key],2)*$p*$q,3).'<br>';


			}
			// echo 'sum a(u-P): '.$t1.'<br>';
			// echo 'sum a*a(PQ): '.$t2.'<br><hr>';
			$c=$theta;
			$kq=$theta+$t1/$t2;
			$theta=$kq; 
			// echo 'delta năng lực'.$t1/$t2.'~~';
			// echo 'năng lực '.$theta.'<br>';

		}while(abs($kq-$c)>0.01);
		// echo'xong'.'<br>';
		$se = 1/sqrt($t2);
		//echo 'SE:'.$se.'<br>';
		return $theta;
	}

	public function SE($array_do_kho,$array_do_phan_biet,$theta)
	{
		$SE = 0;
		$mau = 0;
		foreach ($array_do_kho as $key => $value)
		{
			$P = exp($array_do_phan_biet[$key]*($theta - $array_do_kho["$key"]))/(1+exp($array_do_phan_biet[$key]*($theta - $array_do_kho["$key"])));
			$Q = 1-$P;
			$mau += $array_do_phan_biet[$key]*$array_do_phan_biet[$key]*$P*$Q;
		}

		$SE = (1/sqrt($mau));
		return $SE;
		
	}
	public function ham_thong_tin_cau_hoi($nang_luc,$do_kho_thuc,$do_phan_biet)
	{
		$level_user = $this->chuyen_level_thanh_ty_so($nang_luc);
		if($level_user != 0)
		{
			$nang_luc = log($level_user/(1-$level_user));
		}
		$I = (2.89*pow($do_phan_biet,2))/(exp(1.7*($do_phan_biet)*($nang_luc-$do_kho_thuc))*pow((1+exp(-1.7*($do_phan_biet)*($nang_luc-$do_kho_thuc))),2));
		return $I;
	}





}

/* End of file Myirt.php */
/* Location: ./application/libraries/Facebook/Myirt.php */
 	