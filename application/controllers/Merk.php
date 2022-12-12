<?php defined('BASEPATH') or exit('No direct script access allowed');

class Merk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['model_merk', 'model_kategori']);
	}

	public function index()
	{
		$data = array(
			'title'			=> 'Master Merk Smartphone',
			'row'			=> $this->model_merk->get(),
			'act_merk'		=> 'active',
			'act_merk1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('merk/data');
		$this->load->view('templates/backend_footer');
	}

	public function tambah()
	{
		$merk = new stdClass;
		$merk->id_merk		= null;
		$merk->nama_merk 	= null;

		$data = array(
			'title'				=> 'Master Merk Smartphone',
			'page'				=> 'tambah',
			'row'				=> $merk,
			'idmerk'			=> $this->model_merk->idmerk(),
			'act_merk'			=> 'active',
			'act_merk2'			=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('merk/merk_form');
		$this->load->view('templates/backend_footer');
	}

	public function edit($id)
	{
		$query = $this->model_merk->get($id);

		if ($query->num_rows() > 0) {

			$merk = $query->row();
			$data = array(
				'title' 			=> 'Master Merk Smartphone',
				'page' 				=> 'edit',
				'row'				=> $merk,
				'act_merk'			=> 'active',
				'act_merk2'		=> 'active'
			);

			$this->load->view('templates/backend_header', $data);
			$this->load->view('templates/backend_sidebar');
			$this->load->view('merk/merk_form');
			$this->load->view('templates/backend_footer');
		} else {
			echo "<script>alert('Data tidak ditemukan.');</script>";
			echo "<script>window.location='" . site_url('merk') . "'</script>";
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);

		if (isset($_POST['tambah'])) {
			// $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s harus dipilih'));
			$this->form_validation->set_rules('nama_merk', 'Nama merk', 'required|is_unique[tb_merk.nama_merk]', array('required' => '%s wajib diisi', 'is_unique' => '%s ini sudah ada.'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {
				$this->tambah();
			} else {
				$post = $this->input->post(null, TRUE);
				$this->model_merk->add($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata("sukses", "<small>Merk smartphone baru berhasil ditambahkan.</small>");
				}
				redirect('merk/tambah');
			}
		} else if (isset($_POST['edit'])) {
			// $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s harus dipilih'));
			$this->form_validation->set_rules('nama_merk', 'Nama merk', 'required', array('required' => '%s wajib diisi'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {
				$id = $this->input->post('id_merk');
				$query = $this->model_merk->get($id);

				if ($query->num_rows() > 0) {
					$this->edit($id);
				} else {
					echo "<script> alert('Data tidak ditemukan.');";
					echo "window.location='" . site_url('merk') . "';</script>";
				}
			} else {
				if ($this->model_merk->check_merk($post['nama_merk'], $post['id_merk'])->num_rows() > 0) {
					$this->session->set_flashdata('error', "<small>Merk smartphone  $post[nama_merk] ini sudah ada.</small>");
					redirect('merk/edit/' . $post['id_merk']);
				} else {
					$this->model_merk->edit($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('sukses', '<small>Merk smartphone berhasil diperbaharui.</small>');
					}
					redirect('merk');
				}
			}
		}
	}

	public function hapus($id)
	{
		$this->model_merk->del($id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('sukses', "<small>Data merk berhasil dihapus.</small>");
		}
		redirect('merk');
	}
}
