<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mbank extends CI_Model
{

	public $name;
	public $bank;
	public $number;
	
	function __construct($id='')
	{
		parent::__construct();
	}

	public function insert($data=array())
	{
		$this->db->insert('user_bank',$data);
		return $this->db->insert_id();
	}

	public function set($user_id='',$data=array())
	{
		$this->db->where('user_id',$user_id);
		return $this->db->update('user_bank', $data);
	}

	public function get($id='')
	{
		return $this->db->get_where('user_bank','id='.$id)->row_array();
	}

	public function get_all($user_id='')
	{
		return $this->db->get_where('user_bank','user_id='.$user_id)->result_array();
	}

}