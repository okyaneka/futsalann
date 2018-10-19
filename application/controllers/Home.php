<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['content'] = $this->load->view('inc/banner','',TRUE);
		$this->data['search'] = $this->load->view('inc/search','',TRUE);

		$this->load->view('inc/header',$this->data);
		$this->load->view('page/blank',$this->data);
		$this->load->view('inc/footer',$this->data);
	}
}