<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['current']='home';
		$data['title']='Home';
		$data['template']='frontend/home/index';
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		
		$this->load->view('frontend/layout/home',$data);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */