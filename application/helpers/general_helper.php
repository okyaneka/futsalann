<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('my_head')) 
{
	function my_head()
	{
		// meta
		echo '<title>Futsal</title>';
		echo '<meta charset="utf-8">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	
		// style
		echo '<link rel="icon" type="image/png" href="'.base_url('/assets/images/icon.png').'"/>';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/bootstrap/css/bootstrap.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/line-awesome/css/line-awesome.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/font-awesome/css/fontawesome-all.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/animate/animate.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/fonts/opensans.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/style.css').'">';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/jquery/jquery-3.3.1.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/bootstrap/js/bootstrap.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/ckeditor/ckeditor.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/ckeditor/config.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/js/form.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/js/myupload.js').'"></script>';
	}
}

if ( ! function_exists('price_type')) 
{
	function price_type($id='', $selected_id='')
	{
		$CI = get_instance();

		$CI->load->model(['mprice']);

		$price_types = $CI->mprice->get_price_types();

		$select_form = '<select disabled name="price['.$id.'][type]" style="width: 8em">';

		foreach ($price_types as $type) 
		{
			$selected = ($selected_id == $type['id']) ? 'selected' : '';
			$select_form .= '<option value="'.$type['id'].'" '.$selected.'>'.$type['name'].'</option>';
		}

		$select_form .= '</select>';

		return $select_form;
	}
}

if ( ! function_exists('my_foot')) 
{
	function my_foot()
	{
		
	}
}