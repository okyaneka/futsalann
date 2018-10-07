<?php
/**
 * CodeIgniter
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Futsalann_form {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper(array('bootstrap_form','bootstrap'));
	}

	public function login_form($extra = array())
	{
		// the form
		$form = array(
			array(
				'name' 	=> 'email',
				'type' 	=> 'email',
				'id' 	=> 'email',
				'value' => isset($_POST['email']) ? $_POST['email'] : '',
				'label'	=> 'Email:'
			),
			array(
				'type'	=> 'password',
				'name'	=> 'password',
				'id'	=> 'password',
				'label' => 'Password:',
			),
			array(
				'type'	=> 'checkbox',
				'name'	=> 'remember',
				'id'	=> 'remember',
				'value'	=> TRUE,
				'label'	=> 'Remember me'
			)
		);

		$extra['form_title']  = 'Login';
		$extra['form_description'] = 'Belum punya akun? '.anchor(base_url('user/register'),'Daftar');
		$extra['submit_text'] = 'Login';

		return bootstrap_panel(bootstrap_vertical_form(base_url('user/login'), $form, $extra));
	}

	public function register_form($role='customer')
	{
		// the form
		$form = array(
			array(
				'name' 	=> 'email',
				'type' 	=> 'email',
				'id' 	=> 'email',
				'value' => isset($_POST['email']) ? $_POST['email'] : '',
				'label'	=> 'Email:'
			),
			array(
				'type'	=> 'password',
				'name'	=> 'password',
				'id'	=> 'password',
				'label' => 'Password:',
			),
			array(
				'type'	=> 'password',
				'name'	=> 're-password',
				'id'	=> 're-password',
				'label'	=> 'Ulangi password'
			),
			array(
				'type'	=> 'checkbox',
				'name'	=> 'agree',
				'id'	=> 'agree',
				'value'	=> 'TRUE',
				'label'	=> 'Dengan ini saya menyetujui '.anchor(base_url(),'kebijakan dan privasi').' yang berlaku',
			),
			array(
				'type'	=> 'hidden',
				'name'	=> 'role',
				'id'	=> 'role',
				'value'	=> $role
			),
		);

		$extra = array(
			'form_title' 		=> 'Daftar',
			'form_description'	=> 'Sudah punya akun? '.anchor(base_url('user/login'),'Login'),
			'submit_text'		=> 'Daftar'
		);

		return bootstrap_panel(bootstrap_vertical_form(base_url('user/register'), $form, $extra));
	}

	public function profile_form($uid='', $action='', $extra='')
	{
		$data = $this->CI->muser->get($uid);
		$form = array(
			array(
				'name' 	=> 'meta[firstname]',
				'type' 	=> 'text',
				'id' 	=> 'firstname',
				'value' => isset($_POST['meta']['firstname']) ? $_POST['meta']['firstname'] : ( ! empty($data['meta']['firstname']) ? $data['meta']['firstname'] : ''),
				'label'	=> 'Nama depan'
			),
			array(
				'name' 	=> 'meta[lastname]',
				'type' 	=> 'text',
				'id' 	=> 'lastname',
				'value' => isset($_POST['meta']['lastname']) ? $_POST['meta']['lastname'] : ( ! empty($data['meta']['lastname']) ? $data['meta']['lastname'] : ''),
				'label'	=> 'Nama belakang'
			),
			array(
				'name' 	=> 'meta[phone]',
				'type' 	=> 'text',
				'id' 	=> 'phone',
				'value' => isset($_POST['meta']['phone']) ? $_POST['meta']['phone'] : ( ! empty($data['meta']['phone']) ? $data['meta']['phone'] : ''),
				'label'	=> 'Nomor telepon'
			),
			array(
				'name' 			=> 'address[street]',
				'type' 			=> 'text',
				'id' 			=> 'street',
				'value' 		=> isset($_POST['address']['street']) ? $_POST['address']['street'] : ( ! empty($data['meta']['street']) ? $data['meta']['street'] : ''),
				'label'			=> 'Alamat',
				'placeholder'	=> 'Jalan'
			),
			array(
				'name' 			=> 'address[district]',
				'type' 			=> 'text',
				'id' 			=> 'district',
				'value' 		=> isset($_POST['address']['district']) ? $_POST['address']['district'] : ( ! empty($data['meta']['district']) ? $data['meta']['district'] : ''),
				'placeholder'	=> 'Kecamatan'
			),
			array(
				'name' 			=> 'address[city]',
				'type' 			=> 'text',
				'id' 			=> 'city',
				'value' 		=> isset($_POST['address']['city']) ? $_POST['address']['city'] : ( ! empty($data['meta']['city']) ? $data['meta']['city'] : ''),
				'placeholder'	=> 'Kabupaten / Kota'
			),
			array(
				'name' 			=> 'address[zip]',
				'type' 			=> 'text',
				'id' 			=> 'zip',
				'value' 		=> isset($_POST['address']['zip']) ? $_POST['address']['zip'] : ( ! empty($data['meta']['zip']) ? $data['meta']['zip'] : ''),
				'placeholder'	=> 'Kode pos'
			),
			array(
				'type'	=> 'hidden',
				'name'	=> 'id',
				'id'	=> 'id',
				'value'	=> $uid
			)
		);

		return bootstrap_panel(bootstrap_vertical_form($action, $form, ''));
	}

	public function photo_form($uid='', $action='', $extra='')
	{
		$this->CI->load->library('futsalann_profile');

		$photo = $this->CI->futsalann_profile->profile_photo($uid);

		$form = array(
			array(
				'name' 	=> 'photo',
				'type' 	=> 'file',
				'id' 	=> 'photo',
				'label'	=> 'Ubah photo'
			),
			array(
				'type'	=> 'hidden',
				'name'	=> 'id',
				'id'	=> 'id',
				'value'	=> $uid
			)
		);

		return $photo.bootstrap_horizontal_form($action, $form, $extra, TRUE);
	}

	private function action_bar()
	{
		# code...
	}

	public function field_form($id='')
	{
		$this->CI->load->model('mfield');

		$data = $this->CI->mfield->get($id);

		$form = empty($id) ? form_open(base_url('/field/add')) : form_open(base_url('/field/edit/'.$id)) ;
		$form .= empty($data['error']) ? '' : $this->CI->load->view('inc/field/error_form',$data,TRUE);
		$form .= $this->CI->load->view('inc/field/action_bar',$data,TRUE);
		$form .= $this->CI->load->view('inc/field/title_form', $data, TRUE);
		$form .= $this->CI->load->view('inc/field/gallery_form', $data, TRUE);
		$form .= $this->CI->load->view('inc/field/option_form', $data, TRUE);
		$form .= $this->CI->load->view('inc/field/action_bar', $data, TRUE);
		$form .= '</form>';
		
		return $form;
	}

	public function facility_form($id='', $action='')
	{
		$this->CI->load->model('mfacility');

		if ( ! empty($id)) 
		{
			$data = $this->CI->mfacility->get($id);
		}
		else
		{
			$data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
			$data['description'] = isset($_POST['description']) ? $_POST['description'] : '';
			$data['slug'] = isset($_POST['slug']) ? $_POST['slug'] : '';
		}
		
		$forms = array(
			array(
				'type'	=> 'text',
				'id'	=> 'name',
				'name'	=> 'name',
				'label'	=> 'Nama fasilitas',
				'value' => $data['name'],
			),
			array(
				'type'	=> 'text',
				'id'	=> 'slug',
				'name'	=> 'slug',
				'label'	=> 'Slug (opsional)',
				'value' => $data['slug'],
			),
			array(
				'type'	=> 'textarea',
				'id'	=> 'description',
				'name'	=> 'description',
				'label'	=> 'Deskripsi (opsional)',
				'value' => $data['description'],
			),
		);

		$extra['submit_text']	= 'Tambah fasilitas';

		if ( ! empty($id)) {
			$forms[] = array(
				'type'	=> 'hidden',
				'name'	=> 'id',
				'value'	=> $id,
			);
			
			$extra['submit_text']	= 'Update';
		}


		return bootstrap_vertical_form($action, $forms, $extra);
	}
}
