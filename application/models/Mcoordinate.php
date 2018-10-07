<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mcoordinate extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['mfield']);
	}

	public function insert($field_id='',$lat='',$long='')
	{
		$data['lat'] = array(
			'field_id' => $field_id,
			'name' => 'lat',
			'content' => $lat
		);
		$data['long'] = array(
			'field_id' => $field_id,
			'name' => 'long',
			'content' => $long
		);
		$this->db->insert('field_meta',$data['lat']);
		$insert_id[] = $this->db->insert_id();
		$this->db->insert('field_meta',$data['long']);
		$insert_id[] = $this->db->insert_id();
		return $insert_id;
	}

	public function set($field_id='',$data=array())
	{
		$this->db->where('field_id',$field_id);
		$this->db->where('name','lat');
		$lat = $this->db->update('field_meta',array('content' => $data['lat']));

		$this->db->where('field_id',$field_id);
		$this->db->where('name','long');
		$long = $this->db->update('field_meta',array('content' => $data['long']));

		return array('lat' => $lat, 'long' => $long);
	}

	public function get($field_id='')
	{
		$meta = $this->mfield->get_meta($field_id);
		$coordinates = array(
			'lat' => isset($meta['lat']) ? $meta['lat'] : '',
			'long' => isset($meta['long']) ? $meta['long'] : '',
		);
		return $coordinates;
	}

}