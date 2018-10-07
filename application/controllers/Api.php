<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Api extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function get_price_types()
	{
		$this->load->model('mprice');

		echo json_encode($this->mprice->get_price_types());
	}

	public function get_user_address($id='')
	{
		if (empty($id)) 
		{
			$id = $this->session->user_id;
		}

		$this->load->model('maddress');

		echo json_encode($this->maddress->get_user($id));
	}
}