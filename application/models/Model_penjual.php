<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_penjual extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('tb_penjual');
        if ($id != null) {
            $this->db->where('id_penjual', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function byIdUser($id)
    {
        $this->db->from('tb_penjual');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_penjual'        => $post['kodeunik'],
            'user_id'           => $post['kodeunik'],
            'nama'              => $post['nama'],
            'alamat'            => $post['alamat'] != "" ? $post['alamat'] : null,
            'no_telp'           => $post['no_telp'] != "" ? $post['no_telp'] : null,
            'email'             => $post['email'],
            'nama_bank'         => $post['nama_bank'] != "" ? $post['nama_bank'] : null,
            'no_rek'            => $post['no_rek'] != "" ? $post['no_rek'] : null,
            'image'             => $post['image'] != "" ? $post['image'] : null,
        );
        $this->db->insert('tb_penjual', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_penjual'        => $post['id_penjual'],
            'user_id'           => $post['user_id'],
            'nama'              => $post['nama'],
            'alamat'            => $post['alamat'],
            'no_telp'           => $post['no_telp'],
            'email'             => $post['email'],
            'nama_bank'         => $post['nama_bank'],
            'no_rek'            => $post['no_rek'],
        );

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('id_penjual', $post['id_penjual']);
        $this->db->update('tb_penjual', $params);
    }

    public function nonaktif($id)
    {
        $params = array(
            'akun' => 0
        );
        $this->db->where('id_penjual', $id);
        $this->db->update('tb_penjual', $params);
    }

    public function aktifkan($id)
    {
        $params = array(
            'akun' => 1
        );
        $this->db->where('id_penjual', $id);
        $this->db->update('tb_penjual', $params);
    }
}
