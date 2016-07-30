<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['current']='pages';
		$data['title']='About Us';
		$data['content']='Why our Clients love to work with us.';
		$data['template']='frontend/pages/aboutus';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function about()
	{
		$data['current']='about';
		$data['title']='About Us';
		$data['content']='Why our Clients love to work with us.';
		$data['template']='frontend/pages/aboutus';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function about2()
	{
		$data['current']='about2';
		$data['title']='About Us';
		$data['content']='Why our Clients love to work with us.';
		$data['template']='frontend/pages/aboutus2';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function services()
	{
		$data['current']='services';
		$data['title']='Services';
		$data['content']='Designed to suit you.';
		$data['template']='frontend/pages/service';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function pricing()
	{
		$data['current']='pricing';
		$data['title']='Pricing Table';
		$data['content']='configure your pricing table.';
		$data['template']='frontend/pages/pricing';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function contact()
	{
		$data['current']='contact';
		$data['title']='Contact US';
		$data['content']='Stay close';
		$data['template']='frontend/pages/contact';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function contact2()
	{
		$data['current']='contact2';
		$data['title']='Contact US';
		$data['content']='Stay close';
		$data['template']='frontend/pages/contact2';
		$this->load->view('frontend/layout/user',$data);
	}
	
	public function error()
	{
		$data['title']='Error 404 ';
		$data['current']='error';
		$data['template']='frontend/error/404';
		$this->load->view('frontend/layout/error',$data);
	}
	
	public function coming()
	{
		$data['title']='Coming-soon ';
		$data['current']='coming';
		$data['template']='frontend/coming/coming-soon';
		$this->load->view('frontend/layout/coming',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */