<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ex_upload {

	/*
	Upload
		image
		audio
		video
	Check
	Setting
	*/
	protected $image_extension = array();
	protected $audio_extension = array();

	private $absolute_path = "";

	public function get_absolute_path()
	{
		return $this->absolute_path;
	}

	/**
		Upload image
		Created 2016-03-19
		Author: Ms Suong

		@$file [FILE] file tmp of request
		@$savePath [String] path to save this file
		@$partternPath [String] pattern of URL

		@return empty || $partternPath . filename
		
		Ex: 
		INPUT: FILE[avatar.png], ~/upload/image, /public/image
		OUPUT: /public/image/avatar.png
	*/
	public function upload_image($file, $savePath, $partternPath)
	{
		$this->_upload();	
	}

	public function upload_audio()
	{
		$this->_upload();
	}

	public function check_image()
	{

	}

	public function check_audio()
	{


	}

    protected function _upload()
    {
    }
}