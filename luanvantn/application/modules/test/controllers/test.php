<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['group']['current'] = "test" ;
		$data['title'] = 'Bài Kiểm Tra';
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$data['template'] = 'test_view/index';
		$this->load->view('frontend/layout/user',isset($data)?$data:"");
	}


}

/* End of file test.php */
/* Location: ./application/modules/test/controllers/test.php */