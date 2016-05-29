<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['template'] = 'index';
		$this->load->view('frontend/layout/coming',isset($data)?$data:"");
	}

}

/* End of file review.php */
/* Location: ./application/modules/review/controllers/review.php */