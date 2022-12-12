<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_pembeli extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('tb_pembeli');
        if ($id != null) {
            $this->db->where('id_pembeli', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function byIdUser($id)
    {
        $this->db->from('tb_pembeli');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'id_pembeli'        => $post['kodeunik'],
            'user_id'           => $post['kodeunik'],
            'nama'              => $post['nama'],
            'alamat'            => $post['alamat'] != "" ? $post['alamat'] : null,
            'no_telp'           => $post['no_telp'] != "" ? $post['no_telp'] : null,
            'email'             => $post['email'],
            'nama_bank'         => $post['nama_bank'] != "" ? $post['nama_bank'] : null,
            'no_rek'            => $post['no_rek'] != "" ? $post['no_rek'] : null,
            'image'             => $post['image'] != "" ? $post['image'] : null,
        );
        $this->db->insert('tb_pembeli', $params);
    }

    public function edit($post)
    {
        $params = array(
            'id_pembeli'        => $post['id_pembeli'],
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

        $this->db->where('id_pembeli', $post['id_pembeli']);
        $this->db->update('tb_pembeli', $params);
    }

    public function nonaktif($id)
    {
        $params = array(
            'akun' => 0
        );
        $this->db->where('id_pembeli', $id);
        $this->db->update('tb_pembeli', $params);
    }

    public function aktifkan($id)
    {
        $params = array(
            'akun' => 1
        );
        $this->db->where('id_pembeli', $id);
        $this->db->update('tb_pembeli', $params);
    }
}
