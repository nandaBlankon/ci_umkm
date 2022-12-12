<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembeli extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_pembeli', 'model_user']);
    }

    public function index()
    {
        $data = array(
            'title'             => 'Master Member',
            'row'               => $this->model_pembeli->get(),
            'act_pembeli'       => 'active',
            'act_member'        => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('pembeli/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $pembeli = new stdClass;
        $pembeli->npm              = null;
        $pembeli->user_id         = null;
        $pembeli->nama_depan         = null;
        $pembeli->nama_belakang    = null;
        $pembeli->tgl_lahir         = null;
        $pembeli->jekel             = null;
        $pembeli->no_telp         = null;
        $pembeli->email             = null;
        $pembeli->status_akun     = null;

        $data = array(
            'title'         => 'Tambah pembeli',
            'page'             => 'tambah',
            'row'            => $pembeli,
            'kodeuser'         => $this->model_user->kodeuser(),
            'act_pembeli'        => ' class="font-weight-bold"',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('pembeli/pembeli_form');
        $this->load->view('templates/backend_footer');
    }

    public function edit($id)
    {
        $query = $this->model_pembeli->get($id);

        if ($query->num_rows() > 0) {
            $pembeli = $query->row();
            $data = array(
                'title' => 'Edit pembeli',
                'page'     => 'edit',
                'row'    => $pembeli,
                'act_pembeli'        => ' class="font-weight-bold"'
            );

            $this->load->view('templates/backend_header', $data);
            $this->load->view('pembeli/pembeli_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('pembeli') . "'</script>";
        }
    }

    public function proses()
    {
        $config['upload_path']        = './uploads/pembeli/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']            = 2048;
        $config['file_name']        = 'pembeli-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('npm', 'npm', 'trim|required|numeric|max_length[11]|min_length[11]|is_unique[tb_pembeli.npm]', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.', 'max_length' => '%s tidak boleh lebih dari 11 angka', 'min_length' => '%s tidak boleh kurang dari 11 angka', 'is_unique' => '%s ini sudah terdaftar'));
            $this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required', array('required' => '%s tidak boleh kosong.'));
            $this->form_validation->set_rules('jekel', 'Jenis kelamin', 'trim|required', array('required' => '%s belum dipilih.'));
            $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|numeric', array('required' => '%s tidak boleh kosong.', 'numeric' => '%s harus berisi angka.'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_pembeli.email]', array('required' => '%s wajib diisi.', 'valid_email' => '%s ini tidak valid. Masukkan email yang benar.', 'is_unique' => '%s ini sudah pernah digunakan, gunakan email yang lain.'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => '%s tidak boleh kosong.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->model_user->add($post);
                        $this->model_pembeli->add($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Data pembeli berhasil ditambah');
                        }
                        redirect('pembeli/tambah');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('pembeli/tambah');
                    }
                } else {
                    $post['image'] = null;
                    $this->model_user->add($post);
                    $this->model_pembeli->add($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Data pembeli berhasil ditambah');
                    }
                    redirect('pembeli/tambah');
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
                $query = $this->model_pembeli->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('pembeli') . "';</script>";
                }
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $pembeli = $this->model_pembeli->get($post['npm'])->row();
                        if ($pembeli->image != null) {
                            $target_file = './uploads/pembeli/' . $pembeli->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->model_pembeli->edit($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('sukses', 'Data pembeli berhasil diperbaharui');
                        }
                        redirect('pembeli');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('pembeli/edit/' . $post['npm']);
                    }
                } else {
                    $post['image'] = null;
                    $this->model_pembeli->edit($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Data pembeli berhasil diperbaharui');
                    }
                    redirect('pembeli');
                }
            }
        }
    }

    public function hapus($id)
    {
        $data = $this->model_pembeli->get($id)->row();

        $this->model_pembeli->del($data->user_id);
        $this->model_user->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', "<small>Data pembeli berhasil dihapus.</small>");
        }
        redirect('pembeli');
    }

    public function nonaktif($id)
    {
        $data = $this->model_pembeli->get($id)->row();
        $this->model_pembeli->nonaktif($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Akun ' . $data->nama . ' berhasil dinonaktifkan.');
        }
        redirect('pembeli');
    }

    public function aktifkan($id)
    {
        $data = $this->model_pembeli->get($id)->row();
        $this->model_pembeli->aktifkan($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Akun ' . $data->nama . ' berhasil diaktifkan kembali.');
        }
        redirect('pembeli');
    }
}
