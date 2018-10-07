<?php
/**
 * CodeIgniter
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Futsalann {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper(array('bootstrap_form','bootstrap'));

		$this->CI->load->model(array('muser'));
	}

	public function who_is_login()
	{
		if (isset($this->CI->session->user_id)) 
		{
			return $this->CI->muser->get_role($this->CI->session->user_id);
		}
		else
		{
			return FALSE;
		}
	}
}
