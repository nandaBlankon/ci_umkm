<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_usaha extends CI_Model
{
    public function idusaha()
    {
        $this->db->select('RIGHT(tb_usaha.id_usaha, 4) as kode', FALSE);
        $this->db->order_by('id_usaha', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_usaha'); //cek dulu apakah ada sudah ada kode di tabel.   

        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "IDU-" . $kodemax;    // hasilnya ODJ-0001 dst.
        return $kodejadi;
    }

    public function get($id = null)
    {
        $this->db->from('tb_usaha');
        if ($id != null) {
            $this->db->where('id_usaha', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // menampilkan biodata usaha berdasarkan user_id
    public function usahaSaya($id = null)
    {
        $this->db->from('tb_usaha');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_usaha'      => $post['id_usaha'],
            'user_id'       => $post['user_id'],
            'nama_usaha'    => $post['nama_usaha'],
            'alamat_usaha'  => $post['alamat_usaha'],
            'desa'          => $post['desa'],
            'kecamatan'     => $post['kecamatan'],
            'kabupaten'     => $post['kabupaten'],
            'no_hp'         => $post['no_hp'],
            'jenis_usaha'   => $post['jenis_usaha'],
            'keterangan'    => $post['keterangan'],
        );
        $this->db->insert('tb_usaha', $params);
    }

    public function edit($post)
    {
        $params = [
            'id_usaha'      => $post['id_usaha'],
            'user_id'       => $post['user_id'],
            'nama_usaha'    => $post['nama_usaha'],
            'alamat_usaha'  => $post['alamat_usaha'],
            'desa'          => $post['desa'],
            'kecamatan'     => $post['kecamatan'],
            'kabupaten'     => $post['kabupaten'],
            'no_hp'         => $post['no_hp'],
            'jenis_usaha'   => $post['jenis_usaha'],
            'keterangan'    => $post['keterangan'],
        ];

        $this->db->where('id_usaha', $post['id_usaha']);
        $this->db->update('tb_usaha', $params);
    }

    public function del($id)
    {
        $this->db->where('id_usaha', $id);
        $this->db->delete('tb_usaha');
    }

    public function check_usaha($nama, $id = null)
    {
        $this->db->from('tb_usaha');
        $this->db->where('nama_usaha', $nama);

        if ($id != null) {
            $this->db->where('id_usaha !=', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    // menampilkan semua data usaha berdasarkan jenis usaha UMKM
    public function umkm()
    {
        $this->db->from('tb_usaha');
        $this->db->where('jenis_usaha', 'UMKM');
        $query = $this->db->get();
        return $query;
    }

    // menampilkan semua data usaha berdasarkan jenis usaha Home Industri
    public function homeIndustri()
    {
        $this->db->from('tb_usaha');
        $this->db->where('jenis_usaha', 'Home Industri');
        $query = $this->db->get();
        return $query;
    }
}
