<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	public $data;

	public $conf;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('general','bootstrap_form'));

		$this->load->library(array('futsalann','futsalann_nav','futsalann_profile','futsalann_form','futsalann_table','form_validation'));

		$this->data['title']		= '';
		$this->data['main'] 		= '';
		$this->data['secondary']	= '';

		if (isset($this->session->user_id)) 
		{
			$nav = $this->futsalann->who_is_login().'_nav';
			$this->data['sidebar'] 	= $this->futsalann_nav->$nav();
		} 
		else 
		{
			$this->data['sidebar'] 	= '';
		}
		
		$this->data['breadcrumb'][]	= anchor(base_url(), 'Beranda');

		$this->conf['upload_profile'] = array(
			'upload_path' 	=> './assets/images/profiles/',
			'allowed_types'	=> 'gif|jpg|png|jpeg',
			// 'file_name' 	=>
			'file_ext_tolower' 	=> TRUE,
			'overwrite'	=> TRUE,
			'max_size' 		=> '1024',
			// 'max_width'		=> '',
			// 'max_height' 	=> '',
			// 'min_width' 	=> '',
			// 'min_height' 	=> '',
			// 'max_filename' 	=> '',
			// 'max_filename_increment' 	=> '',
			// 'encrypt_name'	=> '',
			'remove_spaces'	=> TRUE,
			// 'detect_mime' 	=> '',
			// 'mod_mime_fix' 	=> '',
		);
		$this->conf['upload_image'] = array(
			'upload_path' 	=> './assets/images/uploads/',
			'allowed_types'	=> 'gif|jpg|png|jpeg',
			// 'file_name' 	=>
			'file_ext_tolower' 	=> TRUE,
			'overwrite'	=> FALSE,
			// 'max_size' 		=> '1024',
			// 'max_width'		=> '',
			// 'max_height' 	=> '',
			// 'min_width' 	=> '',
			// 'min_height' 	=> '',
			// 'max_filename' 	=> '',
			'max_filename_increment' 	=> '100',
			// 'encrypt_name'	=> '',
			'remove_spaces'	=> TRUE,
			// 'detect_mime' 	=> '',
			// 'mod_mime_fix' 	=> '',
		);
		$this->conf['upload_file'] = array();

		date_default_timezone_set('Asia/Jakarta');
	}

}
