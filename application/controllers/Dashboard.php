<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_user', 'model_usaha', 'model_kategori', 'model_produk']);
	}

	public function index()
	{
		if ($this->fungsi->user_login()->level == 1) {
			$data = array(
				'title'				=> 'Dashboard',
				'kategori'			=> $this->model_kategori->get(),
				'produk'			=> $this->model_produk->get(),
				'umkm'				=> $this->model_usaha->umkm(),
				'homeIndustri'		=> $this->model_usaha->homeIndustri(),
				'act_dashboard'		=> ' active',
			);
		} elseif ($this->fungsi->user_login()->level == 2) {
			$data = array(
				'title'				=> 'Dashboard',
				'act_dashboard'		=> ' active',
				'usahaSaya' 		=> $this->model_usaha->usahaSaya($this->fungsi->user_login()->user_id)->row()
			);
		}
		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('dashboard');
		$this->load->view('templates/backend_footer');
	}

	public function profil()
	{
		$data = array(
			'title'				=> 'Profil Saya',
			'act_profil'		=> ' active',
			'profil' 			=> $this->model_user->profil($this->fungsi->user_login()->user_id)->row(),
			'usahaSaya' 		=> $this->model_usaha->usahaSaya($this->fungsi->user_login()->user_id)->row()
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('profil');
		$this->load->view('templates/backend_footer');
	}

	#Proses insert profi
	public function profilinsert()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('no_telp', 'No telp', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('desa', 'Desa', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required', array('required' => '%s wajib diisi'));

		$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->profil();
		} else {
			$post = $this->input->post(null);

			$this->model_user->addProfil($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Profil berhasil diperbaharui.');
			}
			redirect('dashboard/profil');
		}
	}

	#Proses update akun
	public function profilupdate()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('no_telp', 'No telp', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('desa', 'Desa', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required', array('required' => '%s wajib diisi'));

		$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$query = $this->model_user->get();

			if ($query->num_rows() > 0) {
				$this->index();
			} else {
				echo "<script> alert('Data tidak ditemukan.');";
				echo "window.location='" . site_url('dashboard/profil') . "';</script>";
			}
		} else {
			$post = $this->input->post(null);

			$this->model_user->editProfil($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Profil berhasil diperbaharui.');
			}
			redirect('dashboard/profil');
		}
	}

	#Proses update akun
	public function accountupdate()
	{
		$this->form_validation->set_rules('nama', 'Nama lengkap', 'required', array('required' => '%s wajib diisi'));
		$this->form_validation->set_rules('username', 'Email', 'required|trim|callback_username_check', array('required' => '%s wajib diisi'));

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim');
			$this->form_validation->set_rules(
				'passconf',
				'Ulangi Password',
				'trim|matches[password]',
				array(
					'matches' => '%s tidak sesuai dengan password'
				)
			);
		}
		if ($this->input->post('passconf')) {
			$this->form_validation->set_rules(
				'passconf',
				'Ulangi Password',
				'trim|matches[password]',
				array(
					'matches' => '%s tidak sesuai dengan password'
				)
			);
		}

		$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$query = $this->model_user->get();

			if ($query->num_rows() > 0) {
				$this->index();
			} else {
				echo "<script> alert('Data tidak ditemukan.');";
				echo "window.location='" . site_url('dashboard/profil') . "';</script>";
			}
		} else {
			$post = $this->input->post(null);

			$this->model_user->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Profil berhasil diperbaharui.');
			}
			redirect('dashboard');
		}
	}

	#Proses update foto profil
	public function profilpicupdate()
	{
		$config['upload_path']		= './uploads/profil/';
		$config['allowed_types']	= 'jpg|jpeg|png';
		$config['max_size']			= 2048;
		$config['file_name']		= 'image-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);

		$post = $this->input->post(null, TRUE);

		if (@$_FILES['image']['name'] != null) {
			if ($this->upload->do_upload('image')) {

				$profil = $this->model_user->get($post['user_id'])->row();
				if ($profil->image != null) {
					$target_file = './uploads/profil/' . $profil->image;
					unlink($target_file);
				}

				$post['image'] = $this->upload->data('file_name');
				$this->model_user->editFoto($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('sukses', 'Foto profil berhasil diganti.');
				}
				redirect('dashboard');
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('dashboard');
			}
		} else {
			$post['image'] = null;
			$this->model_user->editFoto($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('sukses', 'Foto profil berhasil diganti.');
			}
			redirect('dashboard');
		}
	}

	public function username_check()
	{
		$post = $this->input->post(null);
		$query = $this->db->query("SELECT * FROM tb_user WHERE username='$post[username]' AND user_id != '$post[user_id]'");

		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} ini sudah dipakai, gunakan yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
