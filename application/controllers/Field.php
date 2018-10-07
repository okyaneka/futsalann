<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Field extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(['mfield','mfacility']);

		$this->data['breadcrumb'][] = 'Lapangan';
	}

	public function index()
	{
		$this->page(1);
	}

	public function page()
	{
		# code...
	}

	public function list($page='')
	{
		// Photo, nama, price, fasilitas, resource
		$this->data['main'] = $this->futsalann_table->field_table($this->session->user_id, 10, $page);
		$this->load->view('single-reverse',$this->data);
		# code...
	}

	public function add()
	{
		if ($this->futsalann->who_is_login() != 'renter') 
		{
			echo 'gak punya akses';
			// nanti redirect gitu
		}
		else
		{
			if ( ! empty($_POST)) 
			{
				$field_id = $this->mfield->insert($_POST);
				redirect(base_url('/field/edit/'.$field_id));
			}

			$this->data['main'] = $this->futsalann_form->field_form();

			$this->load->view('single-reverse',$this->data);
		}
	}

	public function edit($id='')
	{
		if ($this->futsalann->who_is_login() != 'renter') 
		{
			echo 'gak punya akses';
			// nanti redirect gitu
		}
		elseif (empty($id)) 
		{
			echo 'gak ada lapangan nya mau ngedit apaan loe?';
			// redirect juga
		}
		else
		{
			// echo "<pre>".print_r($this->mfield->get($id),TRUE)."</pre>";
			if ( ! empty($_POST)) 
			{
				$this->mfield->set($id, $_POST);
			}
			
			$this->data['main'] = $this->futsalann_form->field_form($id);

			$this->load->view('single-reverse',$this->data);
		}
	}

	public function delete($id='')
	{
		if ($this->futsalann->who_is_login() != 'renter') 
		{
			echo 'gak punya akses';
			// nanti redirect gitu
		}
		else
		{
			$this->mfield->delete($id);

			redirect(base_url('/field/list'));

			$this->data['main'] = $this->futsalann_form->field_form();

			$this->load->view('single-reverse',$this->data);
		}
	}

	public function price($option='',$id='')
	{
		switch ($option) {
			case 'delete':
				echo $this->mprice->delete($id);
				break;
			
			default:
				# code...
				break;
		}
	}

	public function resource()
	{
		# code...
		$this->load->view('single-reverse',$this->data);
	}

	public function facility($option='',$id='')
	{
		if ($this->futsalann->who_is_login() != 'renter') 
		{
			echo 'gak punya akses';
		}
		else
		{
			$this->form_validation->set_rules('name','Nama fasilitas','required');
			
			if ($option == 'delete') 
			{
				$this->mfacility->delete($id);
				redirect('/field/facility');
			}
			elseif ($option == 'edit')
			{
				if ($this->form_validation->run() == TRUE) 
				{
					$this->mfacility->set($_POST);
					redirect('/field/facility');
				}
				else
				{
					$this->data['main'] = $this->futsalann_form->facility_form($id,base_url('/field/facility/edit/'.$id));
				}
			}
			else
			{
				if ($this->form_validation->run() == TRUE) 
				{
					$this->mfacility->insert($_POST);
					redirect('/field/facility');
				}
				else
				{
					$this->data['main'] = $this->futsalann_form->facility_form($id, base_url('/field/facility'));
				}
			}
				
			$this->data['secondary'] = $this->futsalann_table->facility_table($this->session->user_id);

			$this->load->view('double-reverse',$this->data);
		}
	}

	public function gallery($option='')
	{
		switch ($option) {
			case 'delete':
				$this->mfield->delete_image($_POST['id']);
				$images = $this->mfield->get_gallery($_POST['field_id']);
				$data = '';
				foreach ($images as $image) {
					$data .= '<div class="thumbnail pull-left text-center m-10">';
					$data .= anchor(base_url('/assets/images/uploads/'.$image['file']),'<img src="'.base_url('/assets/images/uploads/'.$image['file']).'" alt="'.$image['file'].'">','target="_blank"');
					if ($image['main'] == TRUE) 
					{
						$data .= anchor('#','Main','class="setmain btn btn-sm ismain disabled btn-default" data-id="'.$image['id'].'"');
					}
					else
					{
						$data .= anchor('#','Set main','class="setmain btn btn-sm btn-primary" data-id="'.$image['id'].'"');
					}
					$data .= anchor('#','Hapus','class="delete btn btn-sm btn-danger" data-id="'.$image['id'].'"');
					$data .= '<input type="hidden" name="gallery[]" value="'.$image['id'].'">';
					
					$data .= '</div>';
				}
				echo $data;
				break;
			case 'setmain':
				echo $this->mfield->set_main_image($_POST['id'],$_POST['field_id']);
				break;
			default:
				$this->load->library('upload',$this->conf['upload_image']);
				// $this->upload->initialize();
				// print_r($this->conf['upload_profile']);
				// exit();
				if ($this->upload->do_upload('photo') == FALSE) 
				{
					echo  $this->upload->display_errors();
				} 
				else
				{
					$data = $this->upload->data();
					$image['filename'] = $data['file_name'];

					$image['id'] = $this->mfield->insert_image($data['file_name'], $_POST['field_id']);
					$image['status'] = 'success';
					$image['filename'] = $data['file_name'];
					echo json_encode($image);
				}
				break;
		}
	}
}