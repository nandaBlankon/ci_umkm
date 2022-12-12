<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('model_user');
    }

    public function index()
    {
        $data = array(
            'title'             => 'Pengguna',
            'row'               => $this->model_user->get(),
            'act_user'          => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('user/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules(
            'passconf',
            'Ulangi Password',
            'required|trim|matches[password]',
            array(
                'matches' => '%s tidak sesuai dengan password'
            )
        );
        $this->form_validation->set_rules('level', 'Level', 'required|trim');

        $this->form_validation->set_message('required', '%s tidak boleh kosong.');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/tambah');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->model_user->add($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil disimpan.'); </script>";
            }
            echo "<script> window.location='" . site_url('user') . "';</script>";
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_username_check');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim');
            $this->form_validation->set_rules(
                'passconf',
                'Ulangi Password',
                'trim|matches[password]',
                array(
                    'matches' => '%s tidak sesuai dengan password'
                )
            );
        }
        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules(
                'passconf',
                'Ulangi Password',
                'trim|matches[password]',
                array(
                    'matches' => '%s tidak sesuai dengan password'
                )
            );
        }

        $this->form_validation->set_rules('level', 'Level', 'required|trim');

        $this->form_validation->set_message('required', '%s tidak boleh kosong.');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->model_user->get($id);

            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'user/edit', $data);
            } else {
                echo "<script> alert('Data tidak ditemukan.');";
                echo "window.location='" . site_url('user') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->model_user->edit($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script> alert('Data berhasil diedit.'); </script>";
            }
            echo "<script> window.location='" . site_url('user') . "';</script>";
        }
    }

    public function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_admin WHERE username='$post[username]' AND user_id != '$post[user_id]'");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, gunakan yang lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
