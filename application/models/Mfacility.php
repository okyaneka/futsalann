<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mfacility extends CI_Model
{
	
	function __construct($name='', $slug='', $description='')
	{
		parent::__construct();
	}

	public function insert($field_id='', $data=array())
	{
		if (isset($data['name'])) 
		{
			$facility = array(
				'name'			=> $data['name'],
				'slug'			=> empty($data['slug']) ? strtolower(str_replace(' ', '_', $data['name'])) : $data['slug'],
				'description'	=> isset($data['description']) ? $data['description'] : '',
			);

			if ($this->db->get_where('facility','slug="'.$facility['slug'].'"')->num_rows() == 0) 
			{
				$this->db->insert('facility',$facility);
				$facility_id 	= $this->db->insert_id();
			}
			else
			{
				$facility_id = $this->db->get_where('facility','slug="'.$facility['slug'].'"')->row()->id;
			}
			

			if ( ! empty($field_id)) 
			{
				$this->db->insert('field_facility',['field_id' => $field_id, 'facility_id' => $facility_id]);
			}

			$this->db->where('user_id', $this->session->user_id);
			$this->db->where('facility_id', $facility_id);
			if ($this->db->get('user_facility')->num_rows() == FALSE) {
				$this->db->insert('user_facility',['user_id' => $this->session->user_id, 'facility_id' => $facility_id]);
			}


			return $facility_id;
		}
		elseif ( ! is_array($data)) 
		{
			$facility['name'] = $data;
			$this->insert($field_id, $facility);
		}
		else 
		{
			foreach ($data as $item) {
				$facility['name'] = $item;
				$this->insert($field_id, $facility);
			}
		}
	}

	public function set($data=array(), $id='')
	{
		$id = empty($id) ? $data['id'] : $id ;

		$this->db->where('id', $id);

		$facility = array(
			'name'			=> $data['name'],
			'slug'			=> empty($data['slug']) ? strtolower(str_replace(' ', '_', $data['name'])) : $data['slug'],
			'description'	=> $data['description']
		);

		return $this->db->update('facility', $facility);
	}

	public function get($id='')
	{
		return $this->db->get_where('facility','id='.$id)->row_array();
	}

	public function get_list($user_id='')
	{
		$this->db->select('facility.id, facility.name, facility.slug, facility.description,');
		$this->db->from('facility');
		$this->db->join('user_facility','facility.id = user_facility.facility_id');
		$this->db->join('user','user.id = user_facility.user_id');
		$this->db->where('user.id = '.$user_id);

		return $this->db->get()->result_array();
	}

	public function get_all($field_id='')
	{
		$this->db->where('field_facility.field_id',$field_id);
		$this->db->from('facility');
		$this->db->join('field_facility','facility.id = field_facility.facility_id');
		return $this->db->get()->result_array();
	}

	public function delete($id='')
	{
		return $this->db->delete('facility','id='.$id);
	}
	
	public function delete_all($field_id='')
	{
		return $this->db->delete('field_facility','field_id='.$field_id);
	}
}