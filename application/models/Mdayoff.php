<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mdayoff extends CI_Model
{
	
	function __construct($id='')
	{
		parent::__construct();
	}

	public function insert($data=array())
	{
		$this->db->insert('day_off',$data);
		return $this->db->insert_id();
	}

	public function set($id='', $data=array())
	{
		$this->db->where('id',$id);
		return $this->db->update('day_off',$data);
	}

	public function get($id='')
	{
		return $this->db->get_where('day_off','id='.$id)->row_array();
	}

	public function get_all($renter_id='')
	{
		return $this->db->get_where('day_off','renter_id='.$renter_id)->result_array();
	}

	public function delete($id='')
	{
		return $this->db->delete('day_off','id='.$id);
	}
}