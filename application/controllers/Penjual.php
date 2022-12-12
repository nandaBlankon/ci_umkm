<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penjual extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_penjual', 'model_user']);
    }

    public function index()
    {
        $data = array(
            'title'             => 'Master Member',
            'row'               => $this->model_penjual->get(),
            'act_penjual'       => 'active',
            'act_member'        => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('penjual/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $penjual = new stdClass;
        $penjual->id_penjual    = null;
        $penjual->user_id       = null;
        $penjual->nama          = null;
        $penjual->alamat        = null;
        $penjual->no_telp       = null;
        $penjual->email         = null;
        $penjual->nama_bank     = null;
        $penjual->no_rek        = null;

        $data = array(
            'title'         => 'Tambah penjual',
            'page'          => 'tambah',
            'row'           => $penjual,
            'kodeuser'      => $this->model_user->kodeuser(),
            'act_penjual'   => ' class="font-weight-bold"',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('penjual/penjual_form');
        $this->load->view('templates/backend_footer');
    }

    public function edit($id)
    {
        $query = $this->model_penjual->get($id);

        if ($query->num_rows() > 0) {
            $penjual = $query->row();
            $data = array(
                'title' => 'Edit penjual',
                'page'     => 'edit',
                'row'    => $penjual,
                'act_penjual'        => ' class="font-weight-bold"'
            );

            $this->load->view('templates/backend_header', $data);
            $this->load->view('penjual/penjual_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('penjual') . "'</script>";
        }
    }

    public function proses()
    {
        $config['upload_path']        = './uploads/penjual/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']            = 2048;
        $config['file_name']        = 'penjual-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('npm', 'npm', 'trim|required|numeric|max_length[11]|min_length[11]|is_unique[tb_penjual.npm]', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.', 'max_length' => '%s tidak boleh lebih dari 11 angka', 'min_length' => '%s tidak boleh kurang dari 11 angka', 'is_unique' => '%s ini sudah terdaftar'));
            $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('jekel', 'Jenis kelamin', 'trim|required', array('required' => '%s belum dipilih.'));
            $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|numeric', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_penjual.email]', array('required' => '%s wajib diisi.', 'valid_email' => '%s ini tidak valid. Masukkan email yang benar.', 'is_unique' => '%s ini sudah pernah digunakan, gunakan email yang lain.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => '%s tidak boleh kosong.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->model_user->add($post);
                        $this->model_penjual->add($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Data penjual berhasil ditambah');
                        }
                        redirect('penjual/tambah');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('penjual/tambah');
                    }
                } else {
                    $post['image'] = null;
                    $this->model_user->add($post);
                    $this->model_penjual->add($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Data penjual berhasil ditambah');
                    }
                    redirect('penjual/tambah');
                }
            }
        } else if (isset($_POST['edit'])) {
            $this->form_validation->set_rules('npm', 'npm', 'trim|required|numeric|max_length[11]|min_length[11]', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.', 'max_length' => '%s tidak boleh lebih dari 11 angka', 'min_length' => '%s tidak boleh kurang dari 11 angka'));
            $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('jekel', 'Jenis kelamin', 'trim|required', array('required' => '%s belum dipilih.'));
            $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|numeric', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => '%s wajib diisi.', 'valid_email' => '%s ini tidak valid. Masukkan email yang benar.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('npm');
                $query = $this->model_penjual->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('penjual') . "';</script>";
                }
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $penjual = $this->model_penjual->get($post['npm'])->row();
                        if ($penjual->image != null) {
                            $target_file = './uploads/penjual/' . $penjual->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->model_penjual->edit($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Data penjual berhasil diperbaharui');
                        }
                        redirect('penjual');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('penjual/edit/' . $post['npm']);
                    }
                } else {
                    $post['image'] = null;
                    $this->model_penjual->edit($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Data penjual berhasil diperbaharui');
                    }
                    redirect('penjual');
                }
            }
        }
    }

    public function hapus($id)
    {
        $data = $this->model_penjual->get($id)->row();

        $this->model_penjual->del($data->user_id);
        $this->model_user->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', "<small>Data penjual berhasil dihapus.</small>");
        }
        redirect('penjual');
    }

    public function nonaktif($id)
    {
        $data = $this->model_penjual->get($id)->row();
        $this->model_penjual->nonaktif($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Akun ' . $data->nama . ' berhasil dinonaktifkan.');
        }
        redirect('penjual');
    }

    public function aktifkan($id)
    {
        $data = $this->model_penjual->get($id)->row();
        $this->model_penjual->aktifkan($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Akun ' . $data->nama . ' berhasil diaktifkan kembali.');
        }
        redirect('penjual');
    }
}
