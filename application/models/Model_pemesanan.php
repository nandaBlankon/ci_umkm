<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_pemesanan extends CI_Model
{
    public function kodetransaksi()
    {
        $this->db->select('RIGHT(tb_order.id_order, 4) as kode', FALSE);
        $this->db->order_by('id_order', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_order'); //cek dulu apakah ada sudah ada kode di tabel.   

        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "IDtransaksi-" . date('dmY') . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function tambah_order($data)
    {
        $this->db->insert('tb_order', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function tambah_detail_order($data)
    {
        $this->db->insert('tb_detail_order', $data);
    }

    public function detail_order($id = null)
    {
        $this->db->select('tb_detail_order.*, tb_produk.*, tb_penjual.*');
        $this->db->from('tb_detail_order');
        $this->db->join('tb_produk', 'tb_detail_order.id_produk = tb_produk.id_produk');
        $this->db->join('tb_penjual', 'tb_detail_order.id_penjual = tb_penjual.id_penjual');
        if ($id != null) {
            $this->db->where('id_order', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('tb_order');

        if ($id != null) {
            $this->db->where('id_order', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function transaksiSaya($id)
    {
        $this->db->select('tb_detail_order.*, tb_order.*, tb_produk.*');
        $this->db->from('tb_detail_order');
        $this->db->join('tb_order', 'tb_detail_order.id_order = tb_order.id_order');
        $this->db->join('tb_produk', 'tb_detail_order.id_produk = tb_produk.id_produk');
        $this->db->where('id_pembeli', $id);
        $this->db->order_by('id_do', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function transaksiPelanggan($id)
    {
        $this->db->select('tb_detail_order.*, tb_order.*, tb_produk.*');
        $this->db->from('tb_detail_order');
        $this->db->join('tb_order', 'tb_detail_order.id_order = tb_order.id_order');
        $this->db->join('tb_produk', 'tb_detail_order.id_produk = tb_produk.id_produk');
        $this->db->where('id_penjual', $id);
        $this->db->order_by('id_do', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function transaksiPenjual($id)
    {
        $this->db->select('tb_detail_order.*, tb_order.*, tb_produk.*');
        $this->db->from('tb_detail_order');
        $this->db->join('tb_order', 'tb_detail_order.id_order = tb_order.id_order');
        $this->db->join('tb_produk', 'tb_detail_order.id_produk = tb_produk.id_produk');
        $this->db->order_by('id_do', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function byPenjual($id)
    {
        $this->db->from('tb_order');
        $this->db->where('id_toko', $id);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_order'      => $post['id_order'],
            'id_toko'           => $post['id_toko'],
            'id_pembeli'        => $post['id_pembeli'],
            'id_produk'      => $post['id_produk'],
            'jml_beli'          => $post['jml_beli'],
            'total_harga'       => $post['total_harga'],
            'tgl_checkout'      => $post['tgl_checkout'],
        );
        $this->db->insert('tb_order', $params);
    }

    public function updateStok($post, $stok)
    {
        $params = array(
            'id_produk'      => $post['id_produk'],
            'stok'              => $stok,
        );

        $this->db->where('id_produk', $post['id_produk']);
        $this->db->update('tb_produk', $params);
    }

    public function addStruk($post)
    {
        $params = array(
            'id_order'          => $post['id_order'],
            'bukti_pembayaran'  => $post['bukti_pembayaran'],
        );

        $this->db->where('id_order', $post['id_order']);
        $this->db->update('tb_order', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_order'    => $post['id_order'],
            'user_id'       => $post['user_id'],
            'nama_transaksi'  => $post['nama_transaksi'],
            'alamat_transaksi' => $post['alamat_transaksi'],
            'telp_transaksi'  => $post['telp_transaksi'],
            'kode_pos'      => $post['kode_pos'],
        );

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_order', $post['id_order']);
        $this->db->update('tb_order', $params);
    }

    public function view_by_date($tgl_awal, $tgl_akhir)
    {
        $tgl_awal = $this->db->escape($tgl_awal);
        $tgl_akhir = $this->db->escape($tgl_akhir);
        $this->db->where('DATE(tanggal) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir); // Tambahkan where tanggal nya
        return $this->db->get('tb_order')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }
}
