<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mresource extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mfield');
	}

	public function insert($field_id='', $data=array())
	{
	   /*
	    * $data must have 'field_id', 'name', 'price'
		*/

		if (isset($data['name'])) 
		{
			$this->db->where('name',$data['name']);
			if ($this->db->get('field_resource')->num_rows() == FALSE) 
			{
				$data['field_id'] = $field_id;
				return $this->db->insert('field_resource',$data);
			}
		}
		else
		{
			foreach ($data as $item) 
			{
				$this->insert($field_id, $item);
			}
		}
	}

	public function insert_resource_name($field_id='',$resource_name='')
	{
		$this->db->insert('field_meta',array(
			'field_id' => $field_id,
			'name' => 'resource_name',
			'content' => $resource_name
		));
		return $this->db->insert_id();
	}

	public function set($id='', $data=array())
	{
	   /*
	    * $data must have 'field_id', 'name', 'price'
		*/
		$this->db->where('id',$id);
		return $this->db->update('field_resource', $data);
	}

	public function set_resource_name($field_id='',$resource_name='')
	{
		$this->db->where('field_id',$field_id);
		$this->db->where('name','resource_name');
		return $this->db->update('field_meta',array('content' => $resource_name));
	}

	public function get($id='')
	{
		return $this->db->get_where('field_resource','id='.$id)->row_array();
	}

	public function get_all($field_id='')
	{
		return $this->db->get_where('field_resource','field_id='.$field_id)->result_array();
	}

	public function get_resource_name($field_id='')
	{
		$resource_name = isset($this->mfield->get_meta($field_id)['resource_name']) ? $this->mfield->get_meta($field_id)['resource_name'] : '' ;
		return $resource_name;
	}

	public function delete($id='')
	{
		return $this->db->delete('field_resource','id='.$id);
	}

	public function delete_all($field_id='')
	{
		return $this->db->delete('field_resource','field_id='.$field_id);
	}
}