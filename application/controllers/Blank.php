<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Blank extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->db->select('id');
		$field_id = $this->db->get_where('field','user_id='.$this->session->user_id)->result_array();
		foreach ($field_id as $id) {
			$this->db->or_where('field_id', $id['id']);
		}
		print_r($this->db->get('field_facility')->result_array());
	}
}