<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		// check_admin();
		$this->load->model(['model_produk', 'model_user', 'model_pemesanan', 'model_usaha']);
		$this->usahaSaya = $this->model_usaha->usahaSaya($this->fungsi->user_login()->user_id)->row();
	}

	public function index()
	{
		$profil = $this->model_pembeli->byIdUser($this->fungsi->user_login()->user_id)->row();
		// $transaksi = $this->model_penjualan->getByIdpenjual($profilpenjual->id_penjual);

		$data = array(
			'title'				=> 'Penjualan',
			// 'row'				=> $datapenjualan,
			'act_penjualan'		=> 'active',
			'act_penjualan1'	=> 'active',
			'profil' 			=> $profil,
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('penjualan/data');
		$this->load->view('templates/backend_footer');
	}

	public function laporanTransaksiPenjual()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');

		if (empty($tgl_awal) or empty($tgl_akhir)) {
			$datapenjualan = $this->model_pemesanan->get();
			$data = array(
				'title'				=> 'Transaksi',
				'row'				=> $datapenjualan,
				'act_laporanTransaksiPenjual'		=> 'active',
			);
		} else {
			$transaksi = $this->model_pemesanan->view_by_date($tgl_awal, $tgl_akhir);
			$data = array(
				'title'				=> 'Transaksi',
				'order'				=> $transaksi,
				'act_laporanTransaksiPenjual'		=> 'active',
			);
		}
		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('admin/laporanTransaksiPenjual');
		$this->load->view('templates/backend_footer');
	}

	public function transaksiSaya()
	{
		#menampilkan data penjual berdasarkan id user login
		$profil = $this->model_user->get($this->fungsi->user_login()->user_id)->row();
		#menampilkan data transaksi saya dari tabel tb order
		// $transaksiSaya = $this->model_pemesanan->transaksiSaya($profil->user_id)->result_array();
		#menampilkan data transaksi pembeli, lalu menampilkan datanya ke dalam tabel
		$transaksi = $this->model_pemesanan->transaksiSaya($profil->user_id);

		$data = array(
			'title'				=> 'Transaksi Saya',
			'row'				=> $transaksi,
			'profil' 			=> $profil,
			'usahaSaya'		=> $this->usahaSaya,
			'act_transaksi'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksiSaya');
		$this->load->view('templates/backend_footer');
	}

	public function transaksiPelanggan()
	{
		#menampilkan data penjual berdasarkan id user login
		$profil = $this->model_user->get($this->fungsi->user_login()->user_id)->row();
		#menampilkan data transaksi saya dari tabel tb order
		// $transaksiSaya = $this->model_pemesanan->transaksiSaya($profil->user_id)->result_array();
		#menampilkan data transaksi pembeli, lalu menampilkan datanya ke dalam tabel
		$transaksiPelanggan = $this->model_pemesanan->transaksiPelanggan($profil->user_id);

		$data = array(
			'title'				=> 'Transaksi Pelanggan',
			'row'				=> $transaksiPelanggan,
			'profil' 			=> $profil,
			'usahaSaya'			=> $this->usahaSaya,
			'act_transaksiP'	=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksiPelanggan');
		$this->load->view('templates/backend_footer');
	}

	public function transaksiPenjual()
	{
		#menampilkan data penjual berdasarkan id user login
		$profil = $this->model_penjual->byIdUser($this->fungsi->user_login()->user_id)->row();
		#menampilkan data transaksi pembeli untuk mendapatkan id pembeli
		$transaksi = $this->model_pemesanan->transaksiPenjual($profil->id_penjual)->result_array();
		#menampilkan data transaksi pembeli, lalu menampilkan datanya ke dalam tabel
		$transaksi2 = $this->model_pemesanan->transaksiPenjual($profil->id_penjual);

		$data = array(
			'title'				=> 'Transaksi',
			'row'				=> $transaksi2,
			'profil' 			=> $profil,
			'act_transaksi'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksipenjual');
		$this->load->view('templates/backend_footer');
	}

	public function transaksiPembeli()
	{
		#menampilkan data pembeli berdasarkan id user login
		$profil = $this->model_pembeli->byIdUser($this->fungsi->user_login()->user_id)->row();
		#menampilkan data transaksi berdasarkan pembeli yang login
		$transaksi = $this->model_pemesanan->transaksiPembeli($profil->id_pembeli)->result_array();
		$transaksi2 = $this->model_pemesanan->transaksiPembeli($profil->id_pembeli);
		#menampilkan data detail order berdasarkan id order
		$detailOrder = @$this->model_pemesanan->detail_order($transaksi[0]['id_order'])->result_array();
		#menampilkan data penjual berdasarkan id penjual dalam tabel detail order
		$penjual = $this->model_penjual->get($detailOrder[0]['id_penjual'])->row();

		// $tglcheckout = $transaksi->tgl_checkout;
		$tanggalSekarang = date('Y-m-d');
		#$tanggalDuedate = date("d-m-Y", strtotime($tanggalSekarang.' + '.$bulan.' Years'));


		$data = array(
			'title'				=> 'Transaksi',
			'row'				=> $transaksi2,
			'profil' 			=> $profil,
			'detailOrder' 		=> $detailOrder,
			'penjual' 			=> $penjual,
			'tanggalSekarang' 	=> $tanggalSekarang,
			'act_transaksi'		=> 'active',
		);

		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('transaksi/transaksipembeli');
		$this->load->view('templates/backend_footer');
	}

	public function kirimBarang($id)
	{
		$params = array(
			'status'     => 1
		);

		$this->db->where('id_do', $id);
		$this->db->update('tb_detail_order', $params);

		redirect('transaksi/transaksiPelanggan');
	}

	public function barangDiterima($id)
	{
		$params = array(
			'status'     => 2
		);

		$this->db->where('id_do', $id);
		$this->db->update('tb_detail_order', $params);

		redirect('transaksi/transaksiSaya');
	}
}
