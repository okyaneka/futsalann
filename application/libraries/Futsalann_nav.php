<?php
/**
 * CodeIgniter
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Futsalann_nav {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper(['bootstrap_form','bootstrap']);
	}

	public function customer_nav()
	{
		$list = array(
			array(
				'url' 	=> '#',
				'title'	=> 'Chat'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Ulasan'
			),
			// array(
			// 	'url' 	=> '#',
			// 	'title'	=> 'Pesan bantuan'
			// ),
			array(
				'url' 	=> '#',
				'title'	=> 'Riwayat transaksi'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Komplain'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Pengumuman'
			),
		);

		$nav = bootstrap_listgroup_collapse($list, 'Kotak masuk');

		$list = array(
			array(
				'url' 	=> base_url('#'),
				'title'	=> 'Semua booking'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Riwayat transaksi'
			),
		);

		$nav .= bootstrap_listgroup_collapse($list, 'Booking');

		$list = array(
			array(
				'url' 	=> '#',
				'title'	=> 'Lapangan favorit'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Pengaturan'
			),
		);

		$nav .= bootstrap_listgroup_collapse($list, 'Alat');

		return $nav;
	}

	public function renter_nav()
	{
		$list = array(
			array(
				'url' 	=> '#',
				'title'	=> 'Chat'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Ulasan'
			),
			// array(
			// 	'url' 	=> '#',
			// 	'title'	=> 'Pesan bantuan'
			// ),
			array(
				'url' 	=> '#',
				'title'	=> 'Komplain'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Pengumuman'
			),
		);

		$nav = bootstrap_listgroup_collapse($list, 'Kotak masuk');

		$list = array(
			array(
				'url' 	=> base_url('#'),
				'title'	=> 'Semua booking'
			),
			array(
				'url' 	=> base_url('#'),
				'title'	=> 'Tambah booking'
			),
			array(
				'url' 	=> base_url('#'),
				'title'	=> 'Kalendar'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Riwayat transaksi'
			),
		);

		$nav .= bootstrap_listgroup_collapse($list, 'Booking');

		$list = array(
			array(
				'url' 	=> base_url('/field/list'),
				'title'	=> 'Semua lapangan'
			),
			array(
				'url' 	=> base_url('/field/add'),
				'title'	=> 'Tambah lapangan'
			),
			// array(
			// 	'url' 	=> '#',
			// 	'title'	=> 'Pesan bantuan'
			// ),
			// array(
			// 	'url' 	=> base_url('/field/gallery'),
			// 	'title'	=> 'Galeri'
			// ),
			// array(
			// 	'url' 	=> base_url('/field/resource'),
			// 	'title'	=> 'Resource'
			// ),
			array(
				'url' 	=> base_url('/field/facility'),
				'title'	=> 'Fasilitas'
			),
		);

		$nav .= bootstrap_listgroup_collapse($list, 'Lapangan');

		$list = array(
			array(
				'url' 	=> '#',
				'title'	=> 'Pelanggan favorit'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Statistik'
			),
			array(
				'url' 	=> '#',
				'title'	=> 'Pengaturan'
			),
		);

		$nav .= bootstrap_listgroup_collapse($list, 'Alat');

		return $nav;
	}
}
