<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['current']='blog';
		$data['title']='Blog';
		$data['content']='Blog with right sidebar';
		$data['template']='frontend/blog/blog';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function blog()
	{
		$data['current']='blog';
		$data['title']='Blog';
		$data['content']='Blog with right sidebar';
		$data['template']='frontend/blog/blog';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function blog2()
	{
		$data['current']='blog2';
		$data['title']='Blog';
		$data['content']='Time line';
		$data['template']='frontend/blog/blogtwo';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function blog1()
	{
		$data['current']='blog1';
		$data['title']='Blog';
		$data['content']='Blog with right sidebar';
		$data['template']='frontend/blog/blogone';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function blog3()
	{
		$data['current']='blog3';
		$data['title']='Blog';
		$data['content']='Blog with right sidebar';
		$data['template']='frontend/blog/blogthree';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function blog4()
	{
		$data['current']='blog4';
		$data['title']='Blog';
		$data['content']='Blog with left sidebar';
		$data['template']='frontend/blog/blogfour';
		$this->load->view('frontend/layout/user',$data);
	}
    
	public function blogdetails()
	{
		$data['current']='blogdetails';
		$data['title']='Blog Details';
		$data['content']='Blog with right sidebar';
		$data['template']='frontend/blog/blogdetails';
		$this->load->view('frontend/layout/user',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */