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

	public function renter_nav($active='dashboard')
	{
		$list = array(
			array(
				'link'	=> base_url('user/dashboard'),
				'icon'	=> 'tachometer-alt',
				'text'	=> 'Dashboard'
			),
			array(
				'link'	=> '#',
				'icon'	=> 'box',
				'text'	=> 'Lapangan',
				'child'	=> array(
					array(
						'link'	=> base_url('field/list'),
						'text'	=> 'Semua lapangan'
					),
					array(
						'link'	=> base_url('field/add'),
						'text'	=> 'Tambah lapangan'	
					),
					array(
						'link'	=> base_url('field/facility'),
						'text'	=> 'Fasilitas'
					),
				)
			),
			array(
				'link'	=> '#',
				'icon'	=> 'book',
				'text'	=> 'Booking',
				'child'	=> array(
					array(
						'link'	=> '#',
						'text'	=> 'Semua booking'
					),
					array(
						'link'	=> '#',
						'text'	=> 'Tambah booking'
					),
				)
			),
			array(
				'link'	=> '#',
				'icon'	=> 'calendar-alt',
				'text'	=> 'Kalendar',
			),
			array(
				'link'	=> '#',
				'icon'	=> 'comment-dots',
				'text'	=> 'Chat',
			),
			array(
				'link'	=> '#',
				'icon'	=> 'pencil-alt',
				'text'	=> 'Ulasan',
			),
			array(
				'link'	=> '#',
				'icon'	=> 'exclamation-triangle',
				'text'	=> 'Komplain',
			),
			array(
				'link'	=> '#',
				'icon'	=> 'wrench',
				'text'	=> 'Alat',
				'child'	=> array(
					array(
						'link'	=> '#',
						'text'	=> 'Statistik'
					),
					array(
						'link'	=> '#',
						'text'	=> 'Pengumuman'
					),
				)
			),
			array(
				'link'	=> '#',
				'icon'	=> 'cog',
				'text'	=> 'Pengaturan',
			),
		);

		$content = '<ul class="sidebar-menu" data-widget="tree"><li class="header">MAIN NAVIGATION</li>';

		foreach ($list as $a) 
		{
			$isactive = (strtolower($a['text']) == strtolower($active)) ? 'active' : '' ;
			if ( ! isset($a['child'])) 
			{
				$content .= '<li class="'.$isactive.'"><a href="'.$a['link'].'"><i class="fa fa-'.$a['icon'].'"></i> <span>'.$a['text'].'</span></a></li>';
			}
			else
			{	
				$child 	= '';
				$parent	= (strtolower($a['text']) == strtolower($active)) ? 'active' : '' ;
				foreach ($a['child'] as $b) 
				{
					$isactive = (strtolower($b['text']) == strtolower($active)) ? 'active' : '' ;
					$parent .= $isactive;
					$child .= '<li class="'.$isactive.'"><a href="'.$b['link'].'"><i class="far fa-circle"></i> <span>'.$b['text'].'</span></a></li>';
				}

				$content .= '<li class="treeview '.$parent.'"><a href="'.$a['link'].'"><i class="fa fa-'.$a['icon'].'"></i> <span>'.$a['text'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
				$content .= '<ul class="treeview-menu">';
				$content .= $child;
				$content .= '</ul></li>';
			}

		}
		$content .= '</ul>';

		return $content;
	}

	public function dash_breadcrumb($data='')
	{
		$breadcrumb = '<ol class="breadcrumb">';
		$breadcrumb .= '<li><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a></li>';
		if (is_array($data)) 
		{
			for ($i=0; $i < count($data); $i++) 
			{ 
				if ($i+1 == count($data)) {
					$breadcrumb .= '<li class="active">'.$data[$i].'</li>';
				}
				else
				{
					$breadcrumb .= '<li>'.anchor($data[$i]['link'],$data[$i]).'</li>';
				}
			}
		}
		else
		{
			$breadcrumb .= '<li class="active">'.$data.'</li>';
		}
		$breadcrumb .= '</ol>';

		return $breadcrumb;
	}
}
