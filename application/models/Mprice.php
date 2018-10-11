<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mprice extends CI_Model
{

	private $price_types;

	function __construct()
	{
		parent::__construct();
		$this->load->model('mfield');
		$this->price_types = $this->db->get('price_type')->result_array();
	}

	public function insert($field_id='',$data=array())
	{
		/*
		 * $data must have 'field_id', 'type_id', 'start', 'end', 'price', 'priority'
		 */

		if ( ! (empty($data['start']) && empty($data['end'])))
		{
			$data['field_id'] = $field_id;
			$data['type_id'] = '1';
			$this->db->insert('field_price',$data);
		}
		elseif ( ! (isset($data['start']) && isset($data['end'])))
		{
			foreach ($data as $item) 
			{
				$this->insert($field_id, $item);
			}
		}
	}

	public function insert_base_price($field_id='',$base_price='')
	{
		$this->db->insert('field_meta',array(
			'field_id' => $field_id,
			'name' => 'base_price',
			'content' => $base_price
		));
		return $this->db->insert_id();
	}

	public function set($field_id='', $data=array())
	{
		/*
		 * $data must have 'field_id', 'type_id', 'start', 'end', 'price', 'priority'
		 */
		if ( ! (empty($data['start']) && empty($data['end'])))
		{
			return $this->insert($field_id, $data);
		}
	}

	public function set_base_price($field_id='',$base_price='')
	{
		$this->db->where('field_id',$field_id);
		$this->db->where('name','base_price');
		return $this->db->update('field_meta',array('content' => $base_price));
	}

	public function get($id='')
	{
		$price = $this->db->get_where('field_price','id='.$id)->row_array();
		foreach ($this->price_types as $type) {
			if ($price['type_id'] == $type['id']) {
				$price['type'] = $type['name'];
			}
		}
		return $price;
	}

	public function get_all($field_id='')
	{
		$prices = $this->db->get_where('field_price','field_id='.$field_id)->result_array();
		foreach ($prices as $key => $value) {
			foreach ($this->price_types as $type) {
				if ($prices[$key]['type_id'] == $type['id']) {
					$prices[$key]['type'] = $type['name'];
				}
			}
		}
		return $prices;
	}

	public function get_base_price($field_id='')
	{
		$base_price = isset($this->mfield->get_meta($field_id)['base_price']) ? $this->mfield->get_meta($field_id)['base_price'] : '' ;
		return $base_price;
	}

	public function get_price_types()
	{
		return $this->price_types;
	}

	public function delete($id='')
	{
		return $this->db->delete('field_price','id='.$id);
	}

	public function delete_all($field_id='')
	{
		return $this->db->delete('field_price','field_id='.$field_id);
	}

}