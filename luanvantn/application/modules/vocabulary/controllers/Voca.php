<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voca extends CI_Controller {

	public function index($eng,$vi)
	{
		$vn =urldecode("$vi");
		$en = urldecode("$eng");
		$data = array(
			'id' => "",
			'user_id'=>$this->session->userdata('id'),
			'vocabulary'=>$en,
			'voca_mean' =>$vn
			);

		$a = $this->query_sql->add('vocabularies',$data);

	}

}

/* End of file Voca.php */
/* Location: ./application/modules/vocabulary/controllers/Voca.php */