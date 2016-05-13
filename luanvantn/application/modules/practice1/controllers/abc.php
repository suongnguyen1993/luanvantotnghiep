<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abc extends CI_Controller {

	public function index()
	{
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['template'] = 'a.php';
		$this->load->view('frontend/layout/user',$data);
	}

}

/* End of file abc.php */
/* Location: ./application/modules/practice/controllers/abc.php */