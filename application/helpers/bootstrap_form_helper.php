<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('bootstrap_vertical_form')) 
{
	/**
	 *
	 */
	function bootstrap_vertical_form($action='', $forms='', $extra='', $multipart=FALSE)
	{
		$form = ($multipart === TRUE) ? form_open_multipart($action) : form_open($action);
		$form .= (isset($extra['form_title'])) ? '<h3 align="center">'.$extra['form_title'].'</h3>' : '';
		$form .= (isset($extra['form_description'])) ? '<p align="center">'.$extra['form_description'].'</p>' : '';

		if (is_array($forms))
		{
			foreach ($forms as $item) 
			{
				$form .= '<div class="form-group">';
				if (isset($item['type'])) 
				{
					$item['class'] = 'form-control';
					$item['id'] = (isset($item['id'])) ? $item['id'] : $item['name'] ;

					if ($item['type'] == 'checkbox' || $item['type'] == 'radio') 
					{
						if (isset($item['group'])) 
						{
							$form .= isset($item['label']) ? form_label($item['label'],$item['id']) : '';
							unset($item['label']);
								
						}
					}
					else
					{
						$form .= isset($item['label']) ? form_label($item['label'],$item['id']) : '';
						unset($item['label']);
					}

					switch ($item['type']) {
						case 'checkbox':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $key => $label) {
									$form .= '<div class="checkbox">';
									$form .= '<label for='.$key.'>'.form_checkbox(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="checkbox">';
								$form .= '<label for='.$item['id'].'>'.form_checkbox($item['name'],'yes',$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'radio':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $key => $label) {
									$form .= '<div class="radio">';
									$form .= '<label for='.$key.'>'.form_radio(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="radio">';
								$form .= '<label for='.$item['id'].'>'.form_radio($item['name'],'yes',$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'dropdown':
							if (isset($item['multple'])) 
							{
								$form .= form_multiselect($item['name'],$item['option']);
							}
							else
							{
								$form .= form_dropdown($item['name'],$item['option']);
							}
							break;
						case 'textarea':
							$form .= form_textarea($item);
							break;
						case 'file':
							$form .= form_upload($item);
							break;
						default:
							$form .= form_input($item);
							break;
					}
				}
				$form .= '</div>';
			}
		}
		
		if ( ! empty(validation_errors()) OR isset($extra['error'])) 
		{
			$form .= '<div class="alert alert-danger">';
			$form .= validation_errors();
			$form .= isset($extra['error']) ? '<p>'.$extra['error'].'</p>' : '';
			$form .= '</div>';
		}

		$form .= (isset($extra['submit_text'])) ? form_submit('submit',$extra['submit_text'],'class="form-control"') : form_submit('submit', 'Submit','class="form-control"') ;
		$form .= form_close().'<!-- form -->';

		return $form;
	}
}

if ( ! function_exists('bootstrap_inline_form')) 
{
	/**
	 *
	 */
	function bootstrap_inline_form($action='', $forms='', $multipart=FALSE)
	{
		$form = ($multipart) ? form_open_multipart($action, 'class="form-inline"') : form_open($action, 'class="form-inline"');

		if (is_array($forms))
		{
			foreach ($forms as $item) 
			{
				$form .= '<div class="form-group">';
				if (isset($item['type'])) 
				{
					$item['class'] = 'form-control';
					$item['id'] = (isset($item['id'])) ? $item['id'] : $item['name'] ;
					
					if ($item['type'] == 'checkbox' || $item['type'] == 'radio') 
					{
						if (isset($item['group'])) 
						{
							$form .= isset($item['label']) ? form_label($item['label'],$item['id']) : '';
							unset($item['label']);
								
						}
					}
					else
					{
						$form .= isset($item['label']) ? form_label($item['label'],$item['id']) : '';
						unset($item['label']);
					}

					switch ($item['type']) {
						case 'checkbox':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $key => $label) {
									$form .= '<div class="checkbox">';
									$form .= '<label for='.$key.'>'.form_checkbox(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="checkbox">';
								$form .= '<label for='.$item['id'].'>'.form_checkbox(['name' => $item['name'], 'id' => $item['id']],$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'radio':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $group) {
									$form .= '<div class="radio">';
									$form .= '<label for='.$key.'>'.form_checkbox(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="radio">';
								$form .= '<label for='.$item['id'].'>'.form_checkbox(['name' => $item['name'], 'id' => $item['id']],$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'dropdown':
							if (isset($item['multple'])) 
							{
								$form .= form_multiselect($item['name'],$item['option']);
							}
							else
							{
								$form .= form_dropdown($item['name'],$item['option']);
							}
							break;
						case 'textarea':
							$form .= form_textarea($item);
							break;
						case 'file':
							$form .= form_upload($item);
							break;
						default:
							$form .= form_input($item);
							break;
					}
				}
				$form .= '</div>';
			}
		}

		$form .= (isset($extra['submit_text'])) ? form_submit('submit',$extra['submit_text'],'class="form-control"') : form_submit('submit', 'Submit','class="form-control"') ;
		$form .= form_close().'<!-- form -->';

		return $form;
	}
}

if (! function_exists('bootstrap_horizontal_form')) 
{
	/**
	 *
	 */
	function bootstrap_horizontal_form($action='', $forms='', $extra='', $multipart=FALSE)
	{
		$form = ($multipart) ? form_open_multipart($action,'class="form-horizontal"') : form_open($action,'class="form-horizontal"');
		$form .= (isset($extra['form_title'])) ? '<h3 align="center">'.$extra['form_title'].'</h3>' : '';
		$form .= (isset($extra['form_description'])) ? '<p align="center">'.$extra['form_description'].'</p>' : '';

		if (is_array($forms))
		{
			foreach ($forms as $item) 
			{
				if ($item['type'] == 'hidden') 
				{
					$form .= form_input($item);
					continue;
				}
					
				$error = (empty(form_error($item['name']))) ? '' : 'has-error' ;
				$form .= '<div class="form-group '.$error.'">';
				if (isset($item['type'])) 
				{
					if ($item['type'] == 'checkbox' || $item['type'] == 'radio') 
					{
						if (isset($item['group'])) 
						{
							$form .= isset($item['label']) ? form_label($item['label'],$item['id'],'class="control-label col-md-4"') : form_label('',$item['id'],'class="control-label col-md-4"');
							unset($item['label']);
								
						}
					}
					else
					{
						$form .= isset($item['label']) ? form_label($item['label'],$item['id'],'class="control-label col-md-4"') : form_label('',$item['id'],'class="control-label col-md-4"');
						unset($item['label']);
					}

					$form .= '<div class="col-md-8">';
					$item['class'] = 'form-control';

					switch ($item['type']) {
						case 'checkbox':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $key => $label) {
									$form .= '<div class="checkbox">';
									$form .= '<label for='.$key.'>'.form_checkbox(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="checkbox">';
								$form .= '<label for='.$item['id'].'>'.form_checkbox(['name' => $item['name'], 'id' => $item['id']],$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'radio':
							if (isset($item['group'])) 
							{
								foreach ($item['group'] as $key => $label) {
									$form .= '<div class="radio">';
									$form .= '<label for='.$key.'>'.form_radio(['name' => $item['name'], 'id' => $key],$key).$label.'</label>';
									$form .= '</div>';
								}
							}
							else
							{
								$form .= '<div class="radio">';
								$form .= '<label for='.$item['id'].'>'.form_radio(['name' => $item['name'], 'id' => $item['id']],$item['value']).$item['label'].'</label>';
								$form .= '</div>';
							}
							break;
						case 'dropdown':
							if (isset($item['multple'])) 
							{
								$form .= form_multiselect($item['name'],$item['option']);
							}
							else
							{
								$form .= form_dropdown($item['name'],$item['option']);
							}
							break;
						case 'textarea':
							$form .= form_textarea($item);
							break;
						case 'file':
							$form .= form_upload($item);
							break;
						default:
							$form .= form_input($item);
							break;
					}
					$form .= '</div>';
				}
				else
				{
					// Gak ada tipe nya
				}
				$form .= '</div>';
			}
		}
		
		if ( ! empty(validation_errors()) OR !empty($extra['error'])) 
		{
			$form .= '<div class="alert alert-danger">';
			$form .= validation_errors();
			$form .= !empty($extra['error']) ? '<p>'.$extra['error'].'</p>' : '';
			$form .= '</div>';
		}

  		$form .= '<div class="form-group"><div class="col-md-offset-4 col-md-8">';
		$form .= (isset($extra['submit_text'])) ? form_submit('submit',$extra['submit_text'],'class="btn btn-default"') : form_submit('submit', 'Submit','class="btn btn-default"') ;
		$form .= '</div></div>';
		$form .= form_close().'<!-- form -->';

		return $form;
	}
}