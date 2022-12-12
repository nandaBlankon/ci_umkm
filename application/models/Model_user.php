<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    function kodeunik()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(user_id,4)) AS kd_max FROM tb_user WHERE DATE(tanggal)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy') . $kd;
    }

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function profil($id)
    {
        $this->db->from('tb_profil');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'user_id'   => $post['kodeunik'],
            'username'  => $post['email'],
            'password'  => sha1($post['password']),
            'nama'      => $post['nama'],
            'jekel'      => $post['jekel'],
            'level'     => 2,
        );
        $this->db->insert('tb_user', $params);
    }

    public function edit($post)
    {
        $params['nama'] = $post['nama'];
        $params['username'] = $post['username'];

        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }

        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params);
    }

    public function editProfil($post)
    {
        $params['email'] = $post['email'];
        $params['alamat'] = $post['alamat'];
        $params['no_telp'] = $post['no_telp'];
        $params['desa'] = $post['desa'];
        $params['kecamatan'] = $post['kecamatan'];
        $params['kabupaten'] = $post['kabupaten'];

        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_profil', $params);
    }

    public function addProfil($post)
    {
        $params = array(
            'user_id'   => $post['user_id'],
            'alamat'   => $post['alamat'],
            'email'  => $post['email'],
            'no_telp'  => $post['no_telp'],
            'desa'      => $post['desa'],
            'kecamatan'      => $post['kecamatan'],
            'kabupaten'     => $post['kabupaten'],
        );
        $this->db->insert('tb_profil', $params);
    }

    // edit foto profil 
    public function editFoto($post)
    {
        $params = [
            'user_id' => $post['user_id'],
        ];

        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('user_id', $post['user_id']);
        $this->db->update('tb_user', $params);
    }

    //ambil data penjual dari database
    function get_lapak_list($limit, $start)
    {
        $query = $this->db->get('tb_penjual', $limit, $start);
        return $query;
    }

    //ambil data produk dari database
    function get_produk_list($limit, $start)
    {
        $this->db->select('tb_penjualan.*, tb_merk.*, tb_penjual.*, tb_penjual.nama as nama_lapak');
        // $this->db->from('tb_penjualan');
        $this->db->join('tb_merk', 'tb_merk.id_merk = tb_penjualan.id_merk');
        $this->db->join('tb_penjual', 'tb_penjual.id_penjual = tb_penjualan.id_penjual');
        $query = $this->db->get('tb_penjualan', $limit, $start);
        return $query;
    }
}
