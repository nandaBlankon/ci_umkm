<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_merk extends CI_Model
{

    public function idmerk()
    {
        $this->db->select('RIGHT(tb_merk.id_merk, 4) as kode', FALSE);
        $this->db->order_by('id_merk', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_merk'); //cek dulu apakah ada sudah ada kode di tabel.   

        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function get($id = null)
    {
        // $this->db->select('tb_merk.*, tb_kategori.*');
        $this->db->from('tb_merk');
        // $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_merk.id_kategori');

        if ($id != null) {
            $this->db->where('id_merk', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_merk'   => $post['id_merk'],
            'nama_merk'    => $post['nama_merk'],
        );

        $this->db->insert('tb_merk', $params);
    }

    public function edit($post)
    {
        $params = [
            'id_kategori'   => $post['id_kategori'],
            'nama_merk'    => $post['nama_merk'],
        ];

        $this->db->where('id_merk', $post['id_merk']);
        $this->db->update('tb_merk', $params);
    }

    public function del($id)
    {
        $this->db->where('id_merk', $id);
        $this->db->delete('tb_merk');
    }

    public function check_merk($nama, $id = null)
    {
        $this->db->from('tb_merk');
        $this->db->where('nama_merk', $nama);

        if ($id != null) {
            $this->db->where('id_merk !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }
}
