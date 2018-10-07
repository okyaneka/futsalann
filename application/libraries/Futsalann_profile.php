<?php
/**
 * CodeIgniter
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Futsalann_profile {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper(array('bootstrap_form','bootstrap'));

		$this->CI->load->model(array('muser'));
	}

	public function profile($id='')
	{
		$data = $this->CI->muser->get($id);
		$profile = '<div class="col-md-5">';
		$profile .= $this->profile_photo($id);
		$profile .= '</div>';
		$profile .= '<div class="col-md-7">';
		$profile .= $this->profile_meta($id);
		$profile .= ($this->CI->session->user_id == $id) ? anchor(base_url('user/setting/profile'),'<i class="fa fa-cog p-r-15"></i>Edit profile','class="btn btn-default"') : '' ;
		$profile .= '</div>';

		return bootstrap_panel($profile,'Profil');
	}

	public function profile_meta($id='')
	{
		$data = $this->CI->muser->get($id);
		// nama
		$profile = '<p><i class="fa fa-user p-r-15"></i>'.$data['meta']['firstname'].' '.$data['meta']['lastname'].'</p>';
		// email
		$profile .= '<p><i class="fa fa-envelope p-r-15"></i>'.$data['email'].'</p>';
		// alamat
		$profile .= '<p><i class="fa fa-map p-r-15"></i>'.$data['meta']['street'].', '.$data['meta']['district'].', '.$data['meta']['city'].', '.$data['meta']['zip'].'</p>';
		// telepon
		$profile .= '<p><i class="fa fa-phone p-r-15"></i>'.$data['meta']['phone'].'</p>';

		return $profile;
	}

	public function profile_photo($id='')
	{
		$photo = '';

		if (! empty($id)) 
		{
			$photo = $this->CI->muser->get($id)['meta']['photo'];
			if (! empty($photo)) 
			{
				$photo = 'profiles/'.$photo;
			}
			else
			{
				$photo = 'blank_user.png';	
			}
		}
		else
		{
			$photo = 'blank_user.png';
		}
		return '<div class="col-md-12"><div class="wrapper oval m-b-15"><img src="'.base_url('assets/images/'.$photo).'"></div></div>';
	}
}
