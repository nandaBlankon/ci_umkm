<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_produk extends CI_Model
{
    // menampilkan semua produk
    public function get($id = null)
    {
        $this->db->select('tb_produk.*, tb_kategori.*, tb_produk.slug as slug_produk');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // menampilkan semua produk berdasarkan tb_usaha(id_usaha)
    public function produkSaya($id = null)
    {
        $this->db->select('tb_produk.*, tb_kategori.*, tb_produk.slug as slug_produk');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
        if ($id != null) {
            $this->db->where('id_usaha', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function warna($id = null)
    {
        $this->db->from('tb_warna');

        if ($id != null) {
            $this->db->where('id_warna', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function size($id = null)
    {
        $this->db->from('tb_ukuran');

        if ($id != null) {
            $this->db->where('id_ukuran', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_usaha'       => $post['id_usaha'],
            'id_kategori'   => $post['id_kategori'],
            'judul'         => $post['judul'],
            'deskripsi'     => $post['deskripsi'],
            'harga'         => $post['harga'],
            'stok'          => $post['stok'],
            'satuan'        => $post['satuan'],
            'berat'         => $post['berat'],
            'kondisi'       => $post['kondisi'],
            'slug'          => $post['slug'],
        );
        $this->db->insert('tb_produk', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_usaha'       => $post['id_usaha'],
            'id_kategori'   => $post['id_kategori'],
            'judul'         => $post['judul'],
            'deskripsi'     => $post['deskripsi'],
            'harga'         => $post['harga'],
            'stok'          => $post['stok'],
            'satuan'        => $post['satuan'],
            'berat'         => $post['berat'],
            'kondisi'       => $post['kondisi'],
            'slug'          => $post['slug'],
        );

        $this->db->where('id_produk', $post['id_produk']);
        $this->db->update('tb_produk', $params);
    }

    public function del($id)
    {
        $this->db->where('id_produk', $id);

        $this->db->delete('tb_produk');
    }

    public function check_produk($nama, $id = null)
    {
        $this->db->from('tb_produk');
        $this->db->where('judul', $nama);

        if ($id != null) {
            $this->db->where('id_produk !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    // EDITED WARNA
    public function warnaTerpilih($id = null, $warna = "")
    {
        $this->db->select('*');
        $this->db->from('tb_warna_produk');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }
        if ($warna != "") {
            $this->db->where('id_warna', $warna);
        }

        $query = $this->db->get();
        return $query;
    }
    // END EDITED

    // EDITED UKURAN
    public function sizeTerpilih($id = null, $size = "")
    {
        $this->db->select('*');
        $this->db->from('tb_ukuran_produk');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }
        if ($size != "") {
            $this->db->where('id_ukuran', $size);
        }

        $query = $this->db->get();
        return $query;
    }
    // END EDITED

    public function getImage($id = null)
    {
        $this->db->select('tb_image_produk.*, tb_produk.*');
        $this->db->from('tb_image_produk');
        $this->db->join('tb_produk', 'tb_image_produk.id_produk = tb_produk.id_produk');
        if ($id != null) {
            $this->db->where('id_produk', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function imageById($id)
    {
        $this->db->from('tb_image_produk');
        $this->db->where('id_image', $id);

        $query = $this->db->get();
        return $query;
    }

    public function addFoto($post)
    {
        $params = [
            'id_produk'  => $post['id_produk'],
            'image'         => $post['image'],
        ];
        $this->db->insert('tb_image_produk', $params);
    }

    public function editFoto($post)
    {
        $params = [
            'id_produk' => $post['id_produk'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_image', $post['id_image']);
        $this->db->update('tb_image_produk', $params);
    }

    public function delFoto($id)
    {
        $this->db->where('id_image', $id);
        $this->db->delete('tb_image_produk');
    }

    public function delWarna($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('tb_warna_produk');
    }

    public function delSize($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('tb_ukuran_produk');
    }

    //ambil data produk dari database
    function get_produk_list($limit, $start)
    {
        $this->db->select('tb_produk.*, tb_kategori.*, tb_produk.slug as slug_produk');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.id_kategori');
        $query = $this->db->get('tb_produk', $limit, $start);
        return $query;
    }

    public function find($id)
    {
        $result = $this->db->where('id_produk', $id)->limit(1)->get('tb_produk');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
