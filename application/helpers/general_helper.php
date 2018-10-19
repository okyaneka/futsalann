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
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/flexslider/flexslider.css').'">';
		// echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/flexslider/flexslider-rtl-min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/fonts/opensans.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/util.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/style.css').'">';
	}
}

if ( ! function_exists('my_foot')) 
{
	function my_foot()
	{
		// script
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/jquery/jquery-3.3.1.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/bootstrap/js/bootstrap.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/ckeditor/ckeditor.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/ckeditor/config.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/flexslider/jquery.flexslider-min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/gmap3/gmap3.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/js/form.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/js/myupload.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/js/scripts.js').'"></script>';
	}
}

if ( ! function_exists('my_dash_head')) 
{
	function my_dash_head()
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
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/adminlte/css/AdminLTE.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/vendors/adminlte/css/skins/_all-skins.min.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/fonts/opensans.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/dashboard.css').'">';
		echo '<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/util.css').'">';
	}
}

if ( ! function_exists('my_dash_foot')) 
{
	function my_dash_foot()
	{
		// js
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/jquery/jquery-3.3.1.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/jquery-ui/jquery-ui.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('/assets/vendors/bootstrap/js/bootstrap.min.js').'"></script>';
		// echo '<!-- Morris.js charts -->';
		// echo '<script src="bower_components/raphael/raphael.min.js"></script>';
		// echo '<script src="'.base_url('/assets/vendors/adminlte/bower_components/morris.js/morris.min.js').'"></script>';
		// echo '<!-- Sparkline -->';
		// echo '<script src="'.base_url('/assets/vendors/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js').'"></script>';
		// echo '<!-- jvectormap -->';
		// echo '<script src="'.base_url('/assets/vendors/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js').'"></script>';
		// echo '<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>';
		// echo '<!-- jQuery Knob Chart -->';
		// echo '<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>';
		// echo '<!-- daterangepicker -->';
		// echo '<script src="bower_components/moment/min/moment.min.js"></script>';
		// echo '<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>';
		// echo '<!-- datepicker -->';
		// echo '<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>';
		// echo '<!-- Bootstrap WYSIHTML5 -->';
		// echo '<script src="'.base_url('/assets/vendors/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js').'"></script>';
		// echo '<!-- Slimscroll -->';
		// echo '<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>';
		// echo '<!-- FastClick -->';
		// echo '<script src="bower_components/fastclick/lib/fastclick.js"></script>';
		echo '<!-- DataTables -->';
		echo '<script src="'.base_url('/assets/vendors/datatables.net/js/jquery.dataTables.min.js').'"></script>';
		echo '<script src="'.base_url('/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js').'"></script>';
		// <!-- SlimScroll -->
		// <script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		// <!-- FastClick -->
		// <script src="../../bower_components/fastclick/lib/fastclick.js"></script>
		echo '<script src="'.base_url('/assets/vendors/ckeditor/ckeditor.js').'"></script>';
		echo '<script src="'.base_url('/assets/vendors/ckeditor/config.js').'"></script>';
		echo '<!-- AdminLTE App -->';
		echo '<script src="'.base_url('/assets/vendors/adminlte/js/adminlte.min.js').'"></script>';
		// echo '<!-- AdminLTE dashboard demo (This is only for demo purposes) -->';
		// echo '<script src="'.base_url('/assets/vendors/adminlte/dist/js/pages/dashboard.js').'"></script>';
		echo '<!-- AdminLTE for demo purposes -->';
		echo '<script src="'.base_url('/assets/vendors/adminlte/dist/js/demo.js').'"></script>';
		echo '<script src="'.base_url('/assets/js/dashboard.js').'"></script>';
		echo '<script src="'.base_url('/assets/js/form.js').'"></script>';
		echo '<script src="'.base_url('/assets/js/myupload.js').'"></script>';
		echo '<script type="text/javascript">baseUrl = "'.base_url().'"</script>';
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

if ( ! function_exists('price_format')) 
{
	function price_format($n='')
	{
		return ($n === '') ? '' : number_format( (float) $n, 2, '.', ',');
	}
}