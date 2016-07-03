<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('myirt');
	}	


	public function index()
	{
		$b = 2;
		$O = 0.5;


		$P = $this->myirt->xac_suat_p($O,$b);
		
		

		$t = array(1=>1,2=>0);

		$nang_luc_hien_tai = $this->myirt->cap_nhat_nang_luc($t,$P);
		echo $P ."<br>";
		echo "$nang_luc_hien_tai";

	}

}

/* End of file abc.php */
/* Location: ./application/controllers/abc.php */