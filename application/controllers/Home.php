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
		$this->data['main'] = $this->load->view('inc/banner','',TRUE);
		$this->data['search'] = $this->load->view('inc/search','',TRUE);
		$this->load->view('page/blank',$this->data);
	}
}