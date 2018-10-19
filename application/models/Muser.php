<?php 
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Muser extends CI_Model
{
	private $user_meta = array('firstname','lastname','phone');
	// ,'photo'
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('maddress','mbank','mdayoff'));

	}

	public function insert($data=array())
	{
		$this->db->insert('user',array(
			'email' => $data['email'],
			'password' => $data['password'],
			'role' => $data['role']
		));
		$user_id = $this->db->insert_id();

		$this->insert_meta($user_id);
		$this->insert_photo($user_id);

		// $this->mbank->insert($data['bank']);

		// if ($data['role'] == 'renter') {
		// 	$this->mdayoff->insert($data['dayoff']);
		// }

		$this->maddress->insert_user($user_id);

		return $user_id;
	}

	public function insert_meta($user_id='',$data=array())
	{
		foreach ($this->user_meta as $meta) {
			$this->db->insert('user_meta',array(
				'user_id' => $user_id,
				'name' => $meta,
				'content' => empty($data[$meta]) ? '' : $data[$meta]
			));
		}

		return $user_id;
	}

	public function insert_photo($user_id='',$data='')
	{
		$this->db->insert('user_meta',array(
			'user_id' => $user_id,
			'name' => 'photo',
			'content' => empty($data) ? '' : $data
		));
	}

	public function set_profile($user_id='',$data=array())
	{
		$this->db->where('id',$user_id);
		return $this->db->update('user',$data);
	}

	public function set_photo($user_id='', $photo='')
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('name','photo');
		$this->db->update('user_meta',array('content' => $photo));

		return TRUE;
	}

	public function set_meta($user_id='',$data=array())
	{
		foreach ($this->user_meta as $meta) {
			$this->db->where('user_id',$user_id);
			$this->db->where('name',$meta);
			$this->db->update('user_meta',array('content' => $data[$meta]));
		}

		return TRUE;
	}

	public function get($id='')
	{
		// $this->db->select('')
		// $data = $this->db->get_where('user','id='.$id)->row_array();
		$data = $this->get_meta($id);
		return $data;
	}

	public function get_fullname($id='')
	{
		$data = $this->get($id);
		return $data['firstname'].' '.$data['lastname'];
	}

	public function get_role($id='')
	{
		return $this->db->get_where('user','id='.$id)->row_array()['role'];
	}

	public function get_email($id='')
	{
		return $this->db->get_where('user','id='.$id)->row_array()['email'];
	}

	public function get_meta($user_id='')
	{
		$data = array();
		$metas = $this->db->get_where('user_meta','user_id='.$user_id)->result_array();
		foreach ($metas as $meta) {
			$data[$meta['name']] = $meta['content'];
		}
		return $data;
	}

	public function authenticate($data=array())
	{
		$user_data = $this->db->get_where('user','email="'.$data['email'].'"')->row_array();
		if ( empty($user_data) ) 
		{
			return array(
				'error' => TRUE,
				'data' => 'Email belum terdaftar!'
			);
		} 
		elseif ( ! password_verify($data['password'],$user_data['password']) ) 
		{
			return array(
				'error' => TRUE,
				'data' => 'Password yang anda masukkan salah!'
			);
		}
		else 
		{
			return array(
				'error' => FALSE,
				'data' => $user_data
			);
		}
	}

}