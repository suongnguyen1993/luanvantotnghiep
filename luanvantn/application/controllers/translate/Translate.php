<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Translate extends CI_Controller {

	public function index($inputString)
	{
		
        $this->load->library('My_translator');

        $translation = $this->my_translator->entovi($inputString);
		if(isset($translation[0]))
		{
        	echo str_replace('% 20','',$translation[0]);
        }
        die;
	}

}

/* End of file abc.php */
/* Location: ./application/controllers/abc/abc.php */