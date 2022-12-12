<?php defined('BASEPATH') or exit('No direct script access allowed');

class Usaha extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_user', 'model_usaha', 'model_produk']);
		$this->usahaSaya = $this->model_usaha->usahaSaya($this->fungsi->user_login()->user_id)->row();
	}

	public function index()
	{
		$data = array(
			'title'			=> 'Usaha Saya',
			'row'			=> $this->model_usaha->get(),
			'act_usaha'		=> 'active',
			'act_usaha1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('usaha/data');
		$this->load->view('templates/backend_footer');
	}

	public function usahaSaya()
	{
		$data = array(
			'title'			=> 'Usaha Saya',
			'usahaSaya'		=> $this->usahaSaya,
			'produkSaya'	=> $this->model_produk->produkSaya($this->usahaSaya->id_usaha),
			'act_usaha'		=> 'active',
			'act_usaha1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('usaha/usaha_saya');
		$this->load->view('templates/backend_footer');
	}

	public function tambah()
	{
		$usaha = new stdClass;
		$usaha->id_usaha		= null;
		$usaha->user_id			= null;
		$usaha->nama_usaha		= null;
		$usaha->alamat_usaha	= null;
		$usaha->desa			= null;
		$usaha->kecamatan		= null;
		$usaha->kabupaten		= null;
		$usaha->no_hp			= null;
		$usaha->jenis_usaha		= null;
		$usaha->keterangan		= null;
		$usaha->image_usaha		= null;

		$data = array(
			'title'			=> 'Usaha',
			'row'			=> $usaha,
			'idusaha'		=> $this->model_usaha->idusaha(),
			'usahaSaya'		=> $this->usahaSaya,
			'page'			=> 'tambah',
			'act_usaha'		=> 'active',
			'act_usaha1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('usaha/usaha_form');
		$this->load->view('templates/backend_footer');
	}

	public function edit($id)
	{
		$query = $this->model_usaha->get($id);

		if ($query->num_rows() > 0) {

			$usaha = $query->row();

			$data = array(
				'title'             => 'Usaha Saya',
				'page'                 => 'edit',
				'row'                => $usaha,
				'usahaSaya'		=> $this->usahaSaya,
				'act_usaha'        => 'active',
				'act_usaha2'        => 'active'
			);
			$this->load->view('templates/backend_header', $data);
			$this->load->view('templates/backend_sidebar');
			$this->load->view('usaha/usaha_form');
			$this->load->view('templates/backend_footer');
		} else {
			echo "<script>alert('Data tidak ditemukan.');</script>";
			echo "<script>window.location='" . site_url('usaha/usahaSaya') . "'</script>";
		}
	}

	public function proses()
	{
		$post = $this->input->post(null);

		if (isset($_POST['tambah'])) {
			$this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required', array('required' => '%s belum dipilih'));
			$this->form_validation->set_rules('alamat_usaha', 'Alamat Usaha', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('desa', 'Desa', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('no_hp', 'No Hp/WA', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required', array('required' => '%s harus dipilih'));
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s harus diisi'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {
				$this->tambah();
			} else {
				if ($this->model_usaha->check_usaha($post['nama_usaha'], $post['id_usaha'])->num_rows() > 0) {

					$this->session->set_flashdata('error', "<small>Nama usaha <u>'" . ucwords($post['nama_usaha']) . "'</u> sepertinya sudah digunakan.");
					redirect('usaha/tambah');
				} else {
					$post = $this->input->post(null);
					$this->model_usaha->add($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata("sukses", "Pendaftaran usaha anda berhasil dilakukan, selamat bergabung!!");
					}
					redirect('usaha/usahaSaya');
				}
			}
		} else if (isset($_POST['edit'])) {
			$this->form_validation->set_rules('id_kategori', 'Kategori usaha', 'required', array('required' => '%s belum dipilih'));
			$this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('deskripsi', 'Deskripsi usaha', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('harga', 'Harga usaha', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('stok', 'Stok usaha', 'required', array('required' => '%s harus diisi'));
			$this->form_validation->set_rules('satuan', 'Satuan usaha', 'required', array('required' => '%s harus diisi'));

			$this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

			if ($this->form_validation->run() == FALSE) {

				$id = $this->input->post('id_usaha');
				$query = $this->model_usaha->get($id);

				if ($query->num_rows() > 0) {
					$this->edit($id);
				} else {
					echo "<script> alert('Data tidak ditemukan.');";
					echo "window.location='" . site_url('usaha') . "';</script>";
				}
			} else {
				if ($this->model_usaha->check_usaha($post['judul'], $post['id_usaha'])->num_rows() > 0) {
					$this->session->set_flashdata('error', "<small>Judul $post[judul] sudah ada.</small>");
					redirect('usaha/edit/' . $post['id_usaha']);
				} else {
					$this->model_usaha->edit($post);

					$color = $this->input->post('warna');
					$size = $this->input->post('ukuran');

					$this->db->delete('tb_warna_usaha', array('id_usaha' => $post['id_usaha']));
					$this->db->delete('tb_ukuran_usaha', array('id_usaha' => $post['id_usaha']));

					$result = array();
					foreach ($color as $key => $val) {
						$result[] = array(
							'id_usaha'     => $post['id_usaha'],
							'id_warna'      => $_POST['warna'][$key]
						);
					}

					$resultSize = array();
					foreach ($size as $key => $val) {
						$resultSize[] = array(
							'id_usaha'     => $post['id_usaha'],
							'id_ukuran'     => $_POST['ukuran'][$key]
						);
					}

					//MULTIPLE INSERT TO DETAIL TABLE
					$this->db->insert_batch('tb_warna_usaha', $result);
					$this->db->insert_batch('tb_ukuran_usaha', $resultSize);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('sukses', '<small>Data usaha berhasil diperbaharui.</small>');
					}
					redirect('usaha');
				}
			}
		}
	}

	public function lapPenjual($cat)
	{
		$data = array(
			'title'			=> 'Penjual',
			'cat'			=> $cat,
			'row'			=> $cat == 'umkm' ? $this->model_usaha->umkm() : $this->model_usaha->homeIndustri(),
			'act_lapPenjual'		=> ' active',
			'act_usaha1'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('admin/lapPenjual');
		$this->load->view('templates/backend_footer');
	}
}
