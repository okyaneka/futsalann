<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();

		$this->load->model('muser');

		$this->load->library(['upload']);

		// $this->load->library('futsal_form');
	}
        
	public function index()
	{
		if (isset($this->session->user_id)) 
		{
			redirect(base_url('/user/profile/'.$this->session->user_id));
		}
		else
		{
			redirect(base_url('/user/login'));
		}
	}

	public function login()
	{
		$this->data['breadcrumb'] = '';

		if (isset($this->session->user_id)) 
		{
			redirect(base_url('/user/profile/'.$this->session->user_id));
		}

		$config = array(
			array(
				'field'	=> 'email',
				'label'	=> 'Email',
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) 
		{
			$this->data['main'] = $this->futsalann_form->login_form();
		} 
		else 
		{
			$user_data = $this->muser->authenticate($_POST);
			if ($user_data['error'] === TRUE) 
			{
				$extra['error'] = '<p>'.$user_data['data'].'</p>';
				$this->data['main'] = $this->futsalann_form->login_form($extra);
			}
			else
			{
				$this->session->set_userdata(array('user_id' => $user_data['data']['id']));
				$this->data['main'] = '<h3 align="center">Login sukses</h3>';	
				redirect(base_url('/user/profile/'.$this->session->user_id));
			}
		}
		$this->load->view('inc/header',$this->data);
		$this->load->view('page/mini-reverse', $this->data);
		$this->load->view('inc/footer',$this->data);
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		redirect(base_url());
	}

	public function register($role='customer')
	{
		$this->data['breadcrumb'] = '';

		if (isset($this->session->user_id)) 
		{
			redirect(base_url('/user/profile/'.$this->session->user_id));
		}

		$config = array(
			array(
				'field'	=> 'email',
				'label'	=> 'Email',
				'rules'	=> 'required|is_unique[user.email]'
			),
			array(
				'field'	=> 'password',
				'label'	=> 'Password',
				'rules'	=> 'required|min_length[6]|matches[re-password]'
			),
			array(
				'field'	=> 're-password',
				'label'	=> 'Password',
				'rules'	=> 'required'
			),
			array(
				'field'	=> 'agree',
				'label'	=> 'Kebijikan dan privasi',
				'rules'	=> 'required'
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE) 
		{
			$this->data['main'] = $this->futsalann_form->register_form($role);
		} 
		else 
		{
			$data = array(
				'email'		=> $_POST['email'],
				'password'	=> password_hash($_POST['password'], PASSWORD_BCRYPT),
				'role'		=> $_POST['role']
			);

			$id = $this->muser->insert($data);

			// ini untuk konfirmasi email
			$link = base_url('/user/complete?uid='.$id.'&key='.hash('MD5', $data['email']));
			// $this->data['main'] = 'Silahkan cek alamat email anda untuk melanjutkan ke proses berikutnya';
			$this->data['main'] = anchor($link, 'Klik disini').' untuk melanjutkan ke proses berikutnya';
		}

		$this->load->view('inc/header',$this->data);
		$this->load->view('page/mini-reverse', $this->data);
		$this->load->view('inc/footer',$this->data);
	}

	public function complete($option='')
	{
		$page = 'double';

		$this->data['breadcrumb'] = '';

		if (empty($option)) 
		{
			redirect(base_url('user/complete/first?'.$_SERVER['QUERY_STRING']));
		}

		if ( ! ( isset($_GET['uid']) && isset($_GET['key']) )) 
		{
			$this->load->view('404');
		}
		else
		{
			$user_data = $this->muser->get($_GET['uid']);

			if (hash('MD5', $user_data['email']) == $_GET['key']) 
			{
				// if ($user_data['confirmed'] == TRUE) 
				// {
				// 	$this->load->view('404');
				// }
				
				switch ($option) {
					case 'first':					
						$field = ['meta[firstname]','meta[lastname]','meta[phone]','address[street]','address[district]','address[city]','address[zip]'];
						$label = ['Nama depan','Nama belakang','Nomor telepon','Jalan / Nomor / Desa','Kecamatan','Kabupaten / kota','Kode pos'];

						$config = array();
						for ($i=0; $i < 7; $i++) 
						{ 
							$config[$i] = array(
								'field'	=> $field[$i],
								'label'	=> $label[$i],
								'rules'	=> 'required'
							);

							if ($i === 2 || $i === 6) 
							{
								$config[$i]['rules'] .= '|numeric';
							}
						}

						$this->form_validation->set_rules($config);

						if ($this->form_validation->run() == FALSE) 
						{
							$this->data['main'] = $this->futsalann_profile->profile_photo($_GET['uid']);
							$this->data['main'] .= '<h4 class="text-center">'.$user_data['email'].'</h4>';
							$this->data['secondary'] = $this->futsalann_form->profile_form($_GET['uid'], base_url('user/complete/first?'.$_SERVER['QUERY_STRING']));
						}
						else
						{
							$this->muser->set_meta($_POST['id'],$_POST['meta']);
							$this->maddress->set_user($_POST['id'],$_POST['address']);
							$this->session->set_userdata(array('user_id' => $user_data['id']));

							redirect(base_url('user/complete/second?'.$_SERVER['QUERY_STRING']));
						}
						break;

					case 'second':
						$extra = array();

						if (isset($_POST['submit']))
						{
							$this->upload->initialize($this->conf['upload_profile']);
							// print_r($this->conf['upload_profile']);
							// exit();
							if ( ! $this->upload->do_upload('photo')) 
							{
								$extra['error'] = $this->upload->display_errors();
							}
							else
							{
								$this->muser->set_profile($_GET['uid'],array(
									'confirmation_key' 	=> $_GET['key'],
									'confirmed'			=> 1
								));
								$this->muser->set_photo($_POST['id'],$this->upload->data()['file_name']);
								redirect(base_url('/user/complete/finish?'.$_SERVER['QUERY_STRING']));
							}
						}

						$this->data['main'] = $this->futsalann_form->photo_form($_GET['uid'], base_url('user/complete/second?'.$_SERVER['QUERY_STRING']), $extra);
						$this->data['main'] .= '<div class="col-md-offset-4 col-md-8">'.anchor(base_url('/user/complete/finish?'.$_SERVER['QUERY_STRING']),'Lewati').'</div>';
						$this->data['secondary'] = bootstrap_panel($this->futsalann_profile->profile_meta($_GET['uid']), 'Profile');
						break;

					default:
						$this->muser->set_profile($_GET['uid'],array(
							'confirmation_key' 	=> $_GET['key'],
							'confirmed'			=> 1
						));
						$this->data['main'] = 'Terimakasih telah melengkapi data diri anda. '.anchor(base_url('/user/profile'), 'Klik disini').' untuk menuju halaman profil';
						$page = 'single';

						break;
				}
			}
			else
			{
				// Intine invalid kode konfirmasi ne
			}
		}

		$this->load->view('inc/header',$this->data);
		$this->load->view($page, $this->data);
		$this->load->view('inc/footer',$this->data);
	}

	public function profile($id='')
	{
		if (isset($this->session->user_id) && empty($id)) 
		{
			redirect(base_url('/user/profile/'.$this->session->user_id));
		}

		if ( ! isset($this->session->user_id))
		{
			redirect(base_url('/user/login/'));
			// membuat halaman khusus untuk menampilkan informasi error
		}
		else
		{
			$this->data['title'] = $this->muser->get_fullname($id);
			$this->data['breadcrumb'] = $this->load->view('inc/breadcrumb',$this->data,TRUE);
			// $this->data['breadcrumb'][] = $this->muser->get_fullname($id);
			if ($this->session->user_id == $id) 
			{
				$nav = $this->futsalann->who_is_login().'_nav';

				$this->data['main'] = $this->futsalann_profile->profile($id);
				$this->data['sidebar'] = $this->futsalann_nav->$nav();
				
				$this->load->view('inc/header',$this->data);
				$this->load->view('page/single',$this->data);
				$this->load->view('inc/footer',$this->data);
			}
			else
			{
				$this->data['main'] = $this->futsalann_profile->profile($id);

				$this->load->view('inc/header',$this->data);
				$this->load->view('page/single',$this->data);	
				$this->load->view('inc/footer',$this->data);
			}
		}	

	}

	public function dashboard()
	{
		if ( ! isset($this->session->user_id))
		{
			redirect(base_url('/user/login/'));
			// membuat halaman khusus untuk menampilkan informasi error
		}
		else
		{
			$this->data['user'] 	= $this->muser->get($this->session->user_id);
			$this->data['title']	= 'Dashboard';
			$this->data['breadcrumb'] = $this->futsalann_nav->dash_breadcrumb('Dashboard');

			$this->load->view('dashboard/inc/header',$this->data);
			$this->load->view('dashboard/inc/nav',$this->data);
			$this->load->view('dashboard/dashboard',$this->data);
		}	

	}

	public function setting($option='',$param='')
	{
		$extra = '';

		if ( ! isset($this->session->user_id))
		{
			redirect(base_url('/user/login/'));
			// membuat halaman khusus untuk menampilkan informasi error
		}

		if (empty($option)) 
		{
			redirect(base_url('/user/setting/profile'));
		}

		switch ($option) {
			case 'profile':
				switch ($param) {
					case 1:
						if (isset($_POST['submit'])) 
						{
							$this->upload->initialize($this->conf['upload_profile']);
							// print_r($this->conf['upload_profile']);
							// exit();
							if ( ! $this->upload->do_upload('photo')) 
							{
								$extra['error'] = $this->upload->display_errors();
							}
							else
							{
								$this->muser->set_photo($_POST['id'],$this->upload->data()['file_name']);
								redirect(base_url('/user/setting/profile'));
							}
						}
						break;
					case 2:
						$field = ['meta[firstname]','meta[lastname]','meta[phone]','address[street]','address[district]','address[city]','address[zip]'];
						$label = ['Nama depan','Nama belakang','Nomor telepon','Jalan / Nomor / Desa','Kecamatan','Kabupaten / kota','Kode pos'];

						$config = array();
						for ($i=0; $i < 7; $i++) 
						{ 
							$config[$i] = array(
								'field'	=> $field[$i],
								'label'	=> $label[$i],
								'rules'	=> 'required'
							);

							if ($i === 2 || $i === 6) 
							{
								$config[$i]['rules'] .= '|numeric';
							}
						}

						$this->form_validation->set_rules($config);

						if ($this->form_validation->run() == TRUE) 
						{
							$this->muser->set_meta($_POST['id'],$_POST['meta']);
							$this->maddress->set_user($_POST['id'],$_POST['address']);
							redirect(base_url('/user/setting/profile'));
						}
						break;
					default:
						break;
				}
				break;
			
			default:
				echo "string";

			// membuat halaman khusus untuk menampilkan informasi error
				exit();
				break;
		}

		$this->data['main'] = $this->futsalann_form->photo_form($this->session->user_id, base_url('/user/setting/profile/1'), $extra);
		
		$this->data['secondary'] = $this->futsalann_form->profile_form($this->session->user_id, base_url('/user/setting/profile/2'), $extra);
		
		$this->load->view('page/double-reverse',$this->data);
	}

}