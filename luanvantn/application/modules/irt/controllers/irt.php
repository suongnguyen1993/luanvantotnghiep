<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Irt extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Myirt');
		$this->load->model('query_sql');
		$this->load->model('m_irt');
	}

	public function index()
	{
		$b= array(-1,0,1);
		$a= array(1,1.2,0.8);
		$u = array(1,0,1);
		$theta = 1;
		$this->myirt->likelihood($u,$b,$a,$theta);

		// do
		// 	{
		// 		$t1=0;$t2=0;
		// 		for($i=0;$i<count($u);$i++)
		// 		{
		// 			$p=1/(1+exp(-($theta-$b[$i])));
		// 			//$p = exp($theta - $b[$i])/(1+exp($theta - $b[$i]));
		// 			echo "p = ".$p."; ";
		// 			$q=1-$p;
		// 			$t1+=$a[$i]*($u[$i]-$p);
		// 			$t2+=$a[$i]*$a[$i]*$p*$q;
		// 		}
		// 		$c=$theta;
		// 		$kq=$theta+$t1/$t2;
		// 		echo "se= ".(1/sqrt($t2))." - ";
		// 		echo $kq."<br/>";
		// 		$theta=$kq;
		// 		//$d++;
		// 		//if($d==10)
		// 		//	break;
		// 	}while(abs($kq-$c)>0.001);
			
	}

}

/* End of file irt.php */
/* Location: ./application/modules/irt/controllers/irt.php */