<?php
/**
 * CodeIgniter
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Futsalann_table {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper(array('bootstrap_form','bootstrap'));

		$this->CI->load->model(array('muser','mfacility'));

		$this->CI->load->library(array('table'));
	}

	public function field_table($user_id='',$limit='',$offset='')
	{
		if (empty($user_id)) 
		{
			$user_id = $this->CI->session->user_id;
		}

		$template = array(
        'table_open'            => '<table id="field-table" class="table table-hover table-bordered table-stripped">',

        // 'thead_open'            => '<thead>',
        // 'thead_close'           => '</thead>',

        // 'heading_row_start'     => '<tr>',
        // 'heading_row_end'       => '</tr>',
        // 'heading_cell_start'    => '<th>',
        // 'heading_cell_end'      => '</th>',

        // 'tbody_open'            => '<tbody>',
        // 'tbody_close'           => '</tbody>',

        // 'row_start'             => '<tr>',
        // 'row_end'               => '</tr>',
        // 'cell_start'            => '<td>',
        // 'cell_end'              => '</td>',

        // 'row_alt_start'         => '<tr>',
        // 'row_alt_end'           => '</tr>',
        // 'cell_alt_start'        => '<td>',
        // 'cell_alt_end'          => '</td>',

        // 'table_close'           => '</table>'
        );

		$table = $this->CI->table;
		$table->set_template($template);
		// Photo, nama, price, fasilitas, resource
		$table->set_heading(
			'<input class="check-all" type="checkbox">',
			'<i class="fa fa-image"></i>',
			'Nama lapangan',
			'Tipe lantai',
			'Fasilitas'
		);

		$data = $this->CI->mfield->get_list($user_id, $limit, $offset);

		// print_r(count($data));	
		// if (count($data) == 0) 
		// {
		// 	$table->add_row($checkbox, $nama, $deskripsi);
		// }

		foreach ($data as $row) {
			$view_link	= anchor(base_url('/field/view/'.$row['id']),'Lihat','target="_blank"');
			$edit_link	= anchor(base_url('/field/edit/'.$row['id']),'Edit');
			$delete_link= anchor(base_url('/field/delete/'.$row['id']),'Hapus','class="text-danger"');
			$sku		= 'sku : '.$row['sku'];
			$action_link= '<p class="action-link"><small>'.$view_link.' | '.$edit_link.' | '.$delete_link.' | '.$sku.'</small></p>';

			$checkbox 	= '<input type="checkbox" name="id[]" value="'.$row['id'].'">';
			
			$image_name	= $this->CI->mfield->get_main_image($row['id']);
			$image 		= '<img style="height:4em" class="img-thumbnail" src="'.base_url('/assets/images/uploads/'.$image_name).'">';
			
			$nama 		= anchor(base_url('/field/edit/'.$row['id']),$row['name']).$action_link;

			// $resource 	= '<strong>'.$this->CI->mresource->get_resource_name($row['id']).':</strong></br>';
			// $temp		= array();
			// foreach ($this->CI->mresource->get_all($row['id']) as $res) 
			// {
			// 	$temp[] = $res['name'];
			// }
			// $resource 	.= implode(', ', $temp);
			
			$floor		= $this->CI->mfield->get_meta($row['id'])['floor'];

			$temp 		= array();
			foreach ($this->CI->mfacility->get_all($row['id']) as $fac) {
				$temp[] = $fac['name'];
			}
			$facility 	= implode(', ', $temp);

			// $deskripsi 	= substr($row['description'], 0, 40).'...';

			$table->add_row($checkbox, $image, $nama, $floor, $facility);
		}

		$table = $this->CI->table->generate();

		return $table;
	}

	public function facility_table($user_id='')
	{
		if (empty($user_id)) 
		{
			$user_id = $this->CI->session->user_id;
		}

		$template = array(
        'table_open'            => '<table id="facility-table" class="table table-hover table-stripped">',

        // 'thead_open'            => '<thead>',
        // 'thead_close'           => '</thead>',

        // 'heading_row_start'     => '<tr>',
        // 'heading_row_end'       => '</tr>',
        // 'heading_cell_start'    => '<th>',
        // 'heading_cell_end'      => '</th>',

        // 'tbody_open'            => '<tbody>',
        // 'tbody_close'           => '</tbody>',

        // 'row_start'             => '<tr>',
        // 'row_end'               => '</tr>',
        // 'cell_start'            => '<td>',
        // 'cell_end'              => '</td>',

        // 'row_alt_start'         => '<tr>',
        // 'row_alt_end'           => '</tr>',
        // 'cell_alt_start'        => '<td>',
        // 'cell_alt_end'          => '</td>',

        // 'table_close'           => '</table>'
        );

		$table = $this->CI->table;
		$table->set_template($template);
		$table->set_heading('<input class="check-all" type="checkbox">','Nama fasilitas','Slug','Deskripsi');

		$data = $this->CI->mfacility->get_list($user_id);

		foreach ($data as $row) {
			$edit_link	= anchor(base_url('/field/facility/edit/'.$row['id']),'Edit');
			$delete_link= anchor(base_url('/field/facility/delete/'.$row['id']),'Hapus','class="text-danger"');
			$fac_id		= 'id : '.$row['id'];
			$action_link= '<p class="action-link"><small>'.$edit_link.' | '.$delete_link.' | '.$fac_id.'</small></p>';

			$checkbox 	= '<input type="checkbox" name="id[]" value="'.$row['id'].'">';
			$nama 		= $row['name'].$action_link;
			$slug 		= $row['slug'];
			$deskripsi 	= $row['description'];

			$table->add_row($checkbox, $nama, $slug, $deskripsi);
		}

		$table = $this->CI->table->generate();

		return $table;
	}
}
