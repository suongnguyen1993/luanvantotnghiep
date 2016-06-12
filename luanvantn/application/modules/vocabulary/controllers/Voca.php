<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voca extends CI_Controller {

	public function index()
	{

		$eng = trim($this->input->post('eng'));
		$vi = trim($this->input->post('vi'));

		$id_user = $this->session->userdata('id');

		$check_key = $this->query_sql->select_row('vocabularies','*',array('vocabulary'=>$eng,'user_id'=>$id_user));

		if(empty($check_key))
		{
			$data = array(
			'id' => "",
			'user_id'=>$this->session->userdata('id'),
			'vocabulary'=>$eng,
			'voca_mean' =>$vi
			);

			$a = $this->query_sql->add('vocabularies',$data);
			echo $a;
			
		}

		else
		{
			echo "-2";
		}
		 die;	
	}

	public function tudien($page = 1)
	{
		$data['group']['current'] = "tudien" ;
		$data['group']['group'] =$this->query_sql->select_array("group", "id,name", "",'','');
		$id_user = $this->session->userdata('id');

		$this->load->library('pagination');
		$config = $this->query_sql->_pagination();
		$config['base_url'] = base_url().'vocabulary/voca/tudien/';
		$config['total_rows'] = $this->query_sql->total_where('vocabularies',array('user_id'=>$id_user)  );
		$config['uri_segment'] = 4;
		$total_page = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $total_page)?$total_page:$page;
		$page = (!isset($page) | $page <= 1)?1:$page;
		$this->pagination->initialize($config);
		$data['list_pagination'] = $this->pagination->create_links();
		$data['vocabulary']=$this->query_sql->view_where('*', 'vocabularies', array('user_id'=>$id_user), ($page-1)*$config['per_page'],$config['per_page']);

		if(empty($data['vocabulary']))
		{
			$data['template'] = 'error';
		}
		else
		{
			$data['template'] = 'tudien';
		}
		$this->load->view('frontend/layout/user',isset($data)?$data:"");

	}

	public function delete_tudien($id)
	{
		$a = $this->query_sql->del('vocabularies', array('id'=>$id));

		echo $a;
		die;
	}

}

/* End of file Voca.php */
/* Location: ./application/modules/vocabulary/controllers/Voca.php */