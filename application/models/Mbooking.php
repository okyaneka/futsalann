<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mbooking extends CI_Model
{

	function __construct($id='')
	{
		parent::__construct();
	}

	public function insert($data=array())
	{
		$this->db->insert('booking',$data);
		return $this->db->insert_id();
	}

	public function get($id='')
	{
		return $this->db->get_where('booking','id='.$id)->row_array();
	}

}