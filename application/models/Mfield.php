<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Mfield extends CI_Model
{
	private $option = array('open','close','min_order','max_order');

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('mprice','mfacility','mresource','muser','maddress','mcoordinate'));
	}

	public function insert($data=array())
	{
		if ( ! isset($data['sku'])) 
		{
			$this->db->select('sku');
			$sku = $this->db->get('field')->result_array();
			$no_sku = (count($sku) == 0) ? 0 : $sku[count($sku)-1]['sku'];
			$no = substr($no_sku, 4)+1;
			switch (strlen($no)) {
				case 0: $data['sku'] = 'SKU_0000'.$no; break;
				case 1: $data['sku'] = 'SKU_000'.$no; break;
				case 2: $data['sku'] = 'SKU_00'.$no; break;
				case 3: $data['sku'] = 'SKU_0'.$no; break;
				case 4: $data['sku'] = 'SKU_'.$no; break;
				default: $data['sku'] = 'SKU_'.$no; break;
			}
		}

		$this->db->insert('field',array(
			'user_id' => $this->session->user_id,
			'sku' => $data['sku'],
			'name' => $data['name'],
			'description' => $data['description']
		));
		$field_id = $this->db->insert_id();

		$this->insert_option($field_id, isset($data['option']) ? $data['option'] : array());

		// $this->insert_gallery($field_id, isset($data['gallery']) ? $data['gallery'] : array());
		if (isset($data['gallery'])) 
		{
			$this->set_gallery($field_id, $data['gallery']);
		}

		$this->mprice->insert_base_price($field_id,$data['baseprice']);
		if (isset($data['price'])) 
		{
			$this->mprice->insert($field_id, $data['price']);
		}

		if (isset($data['facility'])) 
		{
			$this->mfacility->insert($field_id, $data['facility']);
		}

		$this->mresource->insert_resource_name($field_id,$data['resname']);
		if (isset($data['facility'])) 
		{
			$this->mresource->insert($field_id, $data['res']);
		}

		$this->maddress->insert_field($field_id, $data['address']);

		$lat = isset($data['lat']) ? $data['lat'] : '';
		$long = isset($data['lpmg']) ? $data['long'] : '';
		$this->mcoordinate->insert($field_id,$lat,$long);

		return $field_id;
	}

	public function insert_option($field_id='',$data=array())
	{
		foreach ($this->option as $option) {
			$this->db->insert('field_meta',array(
				'field_id' => $field_id,
				'name' => $option,
				'content' => isset($data[$option]) ? $data[$option] : ''
			));
		}
		return $field_id;
	}

	public function insert_gallery($field_id='',$data=array())
	{
		foreach ($data as $item) {
			$this->db->insert('field_gallery',array(
				'field_id' => $field_id,
				'file' => $item['file'],
				'main' => $item['main']
			));
		}
		return $field_id;
	}

	public function insert_image($filename='',$field_id='',$main='0')
	{
		$field_id = empty($field_id) ? NULL : $field_id;
		$this->db->insert('field_gallery',array(
			'file' => $filename,
			'main' => $main,
			'field_id' => $field_id,
			'user_id' => $this->session->user_id
		));

		return $this->db->insert_id();
	}

	public function set_main_image($id='', $field_id='')
	{
		$field_id = empty($field_id) ? ' IS NULL' : ' = '.$field_id;
		$this->db->where('field_id'.$field_id);
		echo 'field_id'.$field_id;
		$this->db->update('field_gallery',['main' => '0']);
		// echo $this->db->get_compiled_update();
		
		$this->db->where('id',$id);
		return $this->db->update('field_gallery',['main' => '1']);
	}

	public function set($id='',$data=array())
	{
		$this->db->where('id',$id);
		$this->db->update('field',array(
			'name' => $data['name'],
			'description' => $data['description'],
		));

		// $this->insert_gallery($field_id, $data['gallery']);
		
		$this->set_option($id, $data['option']);

		$this->mprice->delete_all($id);
		if (isset($data['price'])) {
			foreach ($data['price'] as $price) {
				$this->mprice->insert($id, $price);
			}
		}

		$this->mresource->set_resource_name($id,$data['resname']);
		$this->mresource->delete_all($id);
		if (isset($data['res'])) {
			foreach ($data['res'] as $res) {
				$this->mresource->insert($id, $res);
			}
		}

		$this->mfacility->delete_all($id);
		if (isset($data['facility'])) {
			foreach ($data['facility'] as $fac) {
				$this->mfacility->insert($id, $fac);
			}
		}

		$this->maddress->set_field($id, $data['address']);

		// $this->mcoordinate->set($id,$data['coordinate']);

		return TRUE;
	}

	public function set_gallery($id='',$data='')
	{
		if (is_array($data)) 
		{
			foreach ($data as $item) {
				$this->set_gallery($id, $item);
			}
		}
		else
		{
			$this->db->where('id',$data);
			return $this->db->update('field_gallery',['field_id' => $id]);
		}
	}

	public function set_option($id='', $data=array())
	{
		foreach ($data as $key => $value) {
			$this->db->where('field_id',$id);
			$this->db->where('name',$key);
			$this->db->update('field_meta',array('content' => $value));
		}

		return TRUE;
	}

	public function get_meta($id='')
	{
		$data = array();
		$metas = $this->db->get_where('field_meta','field_id='.$id)->result_array();
		foreach ($metas as $meta) {
			$data[$meta['name']] = $meta['content'];
		}
		return $data;
	}

	public function get_option($id='')
	{
		$meta = $this->get_meta($id);
		return array(
			'open' => isset($meta['open']) ? $meta['open'] : '',
			'close' => isset($meta['close']) ? $meta['close'] : '',
			'min_order' => isset($meta['min_order']) ? $meta['min_order'] : '',
			'max_order' => isset($meta['max_order']) ? $meta['max_order'] : '',
		);
	}

	public function get($id='')
	{
		$data = $this->db->get_where('field','id='.$id)->row_array();
		$data['option'] = $this->get_option($id);
		$data['gallery'] = $this->get_gallery($id);
		$data['baseprice'] = $this->mprice->get_base_price($id);
		$data['price'] = $this->mprice->get_all($id);
		$data['facility'] = $this->mfacility->get_all($id);
		$data['resname'] = $this->mresource->get_resource_name($id);
		$data['resource'] = $this->mresource->get_all($id);
		// $data['user'] = $this->muser->get_field($id);
		$data['address'] = $this->maddress->get_field($id);
		$data['coordinate'] = $this->mcoordinate->get($id);

		return $data;
	}

	public function get_list($id='',$limit='',$offset='')
	{
		$this->db->where('user_id',$id);
		$data = $this->db->get('field', $limit, $offset)->result_array();
		
		return $data;
	}

	public function get_main_image($field_id='')
	{
		$this->db->where('main','1');
		$this->db->where('field_id',$field_id);
		return $this->db->get('field_gallery')->row_array();
	}

	public function get_all($limit='', $offset='')
	{
		$data = $this->db->get('field',$limit,$offset)->result_array();
		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['option'] = $this->get_option($data[$i]['id']);
			$data[$i]['price'] = $this->mprice->get_all($data[$i]['id']);
			$data[$i]['facility'] = $this->mfacility->get_all($data[$i]['id']);
			$data[$i]['resource'] = $this->mresource->get_all($data[$i]['id']);
			$data[$i]['user'] = $this->muser->get_field($data[$i]['id']);
			$data[$i]['address'] = $this->maddress->get_field($data[$i]['id']);
			$data[$i]['coordinate'] = $this->mcoordinate->get($data[$i]['id']);
		}

		return $data;
	}

	public function get_gallery($field_id='')
	{
		$field_id = empty($field_id) ? ' IS NULL' : ' = '.$field_id;
		return $this->db->get_where('field_gallery','field_id'.$field_id)->result_array();

	}

	public function delete($id='')
	{
		return $this->db->delete('field','id='.$id);
	}

	public function delete_image($id='')
	{
		return $this->db->delete('field_gallery','id='.$id);
	}

}