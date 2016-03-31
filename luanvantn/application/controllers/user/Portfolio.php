<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['current']='portfolio';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function portfolio()
	{
		$data['current']='portfolio';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function portfolio2()
	{
		$data['current']='portfolio2';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio2';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function portfolio1()
	{
		$data['current']='blog1';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio1';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function portfolio3()
	{
		$data['current']='portfolio3';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio3';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function portfolio4()
	{
		$data['current']='portfolio4';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfolio4';
		$this->load->view('frontend/layout/user',$data);
	}
    
	public function portfoliodetails()
	{
		$data['current']='blogdetails';
		$data['title']='Portfolio';
		$data['content']='Be Creative';
		$data['template']='frontend/portfolio/portfoliodetails';
		$this->load->view('frontend/layout/user',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */