<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Gallery extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if ($this->futsalann->who_is_login() != 'renter') 
		{
			$this->load->view('page/single', $this->data);
			exit();
			// intinya nanti redirrect gitu aja ya... ^_^
		}
	}

	public function index($value='')
	{
		
	}
}