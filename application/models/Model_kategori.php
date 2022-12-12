<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_kategori extends CI_Model
{

    public function idkategori()
    {
        $this->db->select('RIGHT(tb_kategori.id_kategori, 4) as kode', FALSE);
        $this->db->order_by('id_kategori', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_kategori'); //cek dulu apakah ada sudah ada kode di tabel.   

        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "IDK-" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function get($id = null)
    {
        // $this->db->select('tb_kategori.*, tb_brand.*');
        $this->db->from('tb_kategori');
        // $this->db->join('tb_brand', 'tb_kategori.id_brand = tb_brand.id_brand');
        if ($id != null) {
            $this->db->where('id_kategori', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_kategori' => $post['id_kategori'],
            'nama_kategori' => $post['nama_kategori'],
            'slug' => $post['slug'],
            'image' => $post['image'],
        );
        $this->db->insert('tb_kategori', $params);
    }

    public function edit($post)
    {
        $params = [
            'id_kategori' => $post['id_kategori'],
            'nama_kategori' => $post['nama_kategori'],
            'slug' => $post['slug'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_kategori', $post['id_kategori']);
        $this->db->update('tb_kategori', $params);
    }

    public function del($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('tb_kategori');
    }

    public function check_kategori($nama, $id = null)
    {
        $this->db->from('tb_kategori');
        $this->db->where('nama_kategori', $nama);

        if ($id != null) {
            $this->db->where('id_kategori !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }
}
