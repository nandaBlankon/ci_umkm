<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// check_not_login();
		// check_admin();
		$this->load->model(['model_user', 'model_penjual', 'model_kategori', 'model_produk', 'model_pembeli', 'model_pemesanan']);
	}

	public function detail($id)
	{
		#check_already_login();

		$jenis = $this->model_jenis->get();

		$data = array(
			'title' 	=> 'Home',
			'act_home'	=> 'active',
			'datajenis' => $jenis,
			'penjualan' => $this->model_penjualan->get($id)->row(),
			'profil' 	=> $this->model_pembeli->byIdUser($this->fungsi->user_login()->user_id)->row()
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/detail');
		$this->load->view('templates/frontend_footer');
	}

	public function beli()
	{
		$post = $this->input->post(null);

		$data = array(
			'title' 	=> 'Home',
			'act_home'	=> 'active',
			#'datajenis' => $jenis,
			'penjualan' => $this->model_penjualan->get($post['id_penjualan'])->row(),
			'toko' 		=> $this->model_toko->get($post['id_toko'])->row(),
			'profil' 	=> $this->model_pembeli->byIdUser($this->fungsi->user_login()->user_id)->row(),
			'post' 		=> $post,
			'kodetransaksi' => $this->model_pemesanan->kodetransaksi(),
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/beli');
		$this->load->view('templates/frontend_footer');
	}

	public function checkout()
	{
		$post = $this->input->post(null);
		$penjualan = $this->model_penjualan->get($post['id_penjualan'])->row();
		$stok = $penjualan->stok - $post['jml_beli'];
		$this->model_pemesanan->add($post);
		$this->model_pemesanan->updateStok($post, $stok);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("sukses", "Proses transaksi anda berhasil.");
		}
		redirect('pemesanan/pesan');
	}

	public function pesan()
	{
		$data = array(
			'title' 	=> 'Home',
			'act_home'	=> 'active',
		);

		$this->load->view('templates/frontend_header', $data);
		$this->load->view('pemesanan/pesan');
		$this->load->view('templates/frontend_footer');
	}

	public function uploadstruk()
	{
		$config['upload_path']		= './uploads/struk/';
		$config['allowed_types']	= 'jpg|jpeg|png';
		$config['max_size']			= 2048;
		$config['file_name']		= 'struk-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);

		$post = $this->input->post(null);

		if (@$_FILES['bukti_pembayaran']['name'] != null) {
			if ($this->upload->do_upload('bukti_pembayaran')) {
				$post['bukti_pembayaran'] = $this->upload->data('file_name');
				$this->model_pemesanan->addStruk($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('sukses', 'Bukti pembayaran berhasil diupload.');
				}
				redirect('transaksi/transaksiSaya');
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('transaksi/transaksiSaya');
			}
		}
	}
}
