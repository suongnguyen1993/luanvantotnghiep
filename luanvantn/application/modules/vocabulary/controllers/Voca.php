<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voca extends CI_Controller {

	public function index()
	{
		$data = array(
			'id' => "",
			'user_id'=>$this->session->userdata('id'),
			'vocabulary'=>$this->input->post('eng'),
			'voca_mean' =>$this->input->post('vi')
			);

		$a = $this->query_sql->add('vocabularies',$data);
		print_r($a);
		die;

	}

}

/* End of file Voca.php */
/* Location: ./application/modules/vocabulary/controllers/Voca.php */