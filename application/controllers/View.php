<?php defined('BASEPATH') or exit('No direct script access allowed');

class View extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_not_login();
        // check_admin();
        //load libary pagination
        $this->load->library('pagination');
        $this->load->library('cart');
        $this->load->model(['model_user', 'model_kategori', 'model_pemesanan', 'model_produk', 'model_usaha']);
        $this->kategori = $this->model_kategori->get();
    }

    public function index($slug)
    {
        $this->db->select('tb_produk.*, tb_kategori.*, tb_produk.slug as slug_produk');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
        $this->db->where('tb_produk.slug', $slug);
        $cek_row = $this->db->get()->row();

        $data = array(
            'title'         => 'Produk',
            'produk'        => $cek_row,
            'kategori'      => $this->kategori,
            'act_produk'    => 'active',
        );

        $this->load->view('templates/frontend_header', $data);
        $this->load->view('pages/produk');
        $this->load->view('templates/frontend_footer');
    }

    public function kategori($slug)
    {
        $this->db->from('tb_kategori');
        $this->db->where('slug', $slug);
        $cek_row = $this->db->get()->row();

        $data = array(
            'title'         => 'Kategori',
            'kategori'        => $cek_row,
            'umkm'        => $this->model_usaha->umkm(),
            'homeIndustri'    => $this->model_usaha->homeIndustri(),
        );

        $this->load->view('templates/frontend_header', $data);
        $this->load->view('pages/kategori');
        $this->load->view('templates/frontend_footer');
    }
}
