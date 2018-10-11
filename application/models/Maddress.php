<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Maddress extends CI_Model
{

	private $address = array('street','district','city','zip');
	function __construct($id='')
	{
		parent::__construct();
		$this->load->model('mfield');
		$this->load->model('muser');
	}

	public function insert_field($field_id='',$data=array())
	{
		foreach ($this->address as $address) {
			$this->db->insert('field_meta',array(
				'field_id' => $field_id,
				'name' => $address,
				'content' => isset($data[$address]) ? $data[$address] : ''
			));
		}
		return $field_id;
	}

	public function insert_user($user_id='',$data=array())
	{
		foreach ($this->address as $address) {
			$this->db->insert('user_meta',array(
				'user_id' => $user_id,
				'name' => $address,
				'content' => isset($data[$address]) ? $data[$address] : ''
			));
		}
		return $user_id;
	}

	public function set_field($field_id='',$data=array())
	{
		foreach ($this->address as $address) {
			$this->db->where('field_id',$field_id);
			$this->db->where('name',$address);
			$this->db->update('field_meta',array('content' => $data[$address]));
		}
		return $field_id;
	}

	public function set_user($user_id='',$data=array())
	{
		foreach ($this->address as $address) {
			$this->db->where('user_id',$user_id);
			$this->db->where('name',$address);
			$this->db->update('user_meta',array('content' => $data[$address]));
		}
		return $user_id;
	}

	public function get_field($field_id='')
	{
		$meta = $this->mfield->get_meta($field_id);
		return array(
			'street' => isset($meta['street']) ? $meta['street'] : '',
			'district' => isset($meta['district']) ? $meta['district'] : '',
			'city' => isset($meta['city']) ? $meta['city'] : '',
			'zip' => isset($meta['zip']) ? $meta['zip'] : ''
		);
	}

	public function get_user($user_id='')
	{
		$meta = $this->muser->get_meta($user_id);
		return array(
			'street' => $meta['street'],
			'district' => $meta['district'],
			'city' => $meta['city'],
			'zip' => $meta['zip']
		);
	}

}