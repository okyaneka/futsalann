<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Morder extends CI_Model
{

	private $order_status;
	
	function __construct($id='')
	{
		parent::__construct();
		$this->order_status = $this->db->get('order_status')->result_array();
	}

	public function insert($data=array())
	{
		$this->db->insert('order',$data);
		return $this->db->insert_id();
	}

	public function set_status($id='',$status)
	{
		$this->db->where('id',$id);
		return $this->db->update('order',array('status' => $status));
	}

	public function get($id='')
	{
		return $this->db->get_where('order','id='.$id)->row_array();
	}

	public function get_order_status()
	{
		return $this->order_status;
	}

}