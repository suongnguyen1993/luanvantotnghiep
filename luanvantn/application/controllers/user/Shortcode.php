<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shortcode extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['current']='shortcodes';
		$data['title']='Shortcodes';
		$data['content']='Be Creative';
		$data['template']='frontend/shortcodes/shortcodes';
		$this->load->view('frontend/layout/user',$data);
	}
	public function shortcodes()
	{
		$data['current']='shortcodes';
		$data['title']='Shortcodes';
		$data['content']='Be Creative';
		$data['template']='frontend/shortcodes/shortcodes';
		$this->load->view('frontend/layout/user',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */