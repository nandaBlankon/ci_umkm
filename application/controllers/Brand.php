<?php defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_brand']);
    }

    public function index()
    {
        $data = array(
            'title'             => 'Brand',
            'row'               => $this->model_brand->get(),
            'act_brand'        => 'active',
            'act_brand1'        => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('brand/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $brand = new stdClass;
        $brand->id_brand      = null;
        $brand->nama_brand     = null;

        $data = array(
            'title'            => 'Brand',
            'page'            => 'tambah',
            'row'            => $brand,
            'idbrand'     => $this->model_brand->idbrand(),
            'act_brand'    => 'active',
            'act_brand2'    => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('brand/brand_form');
        $this->load->view('templates/backend_footer');
    }

    public function edit($id)
    {
        $query = $this->model_brand->get($id);

        if ($query->num_rows() > 0) {
            $brand = $query->row();
            $data = array(
                'title' => 'brand',
                'page'     => 'edit',
                'row'    => $brand,
                'act_brand'        => 'active'
            );
            $this->load->view('templates/backend_header', $data);
            $this->load->view('templates/backend_sidebar');
            $this->load->view('brand/brand_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('brand') . "'</script>";
        }
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('nama_brand', 'Nama Brand', 'required|is_unique[tb_brand.nama_brand]', array('required' => '%s wajib diisi', 'is_unique' => '%s ini sudah ada.'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                $post = $this->input->post(null, TRUE);
                $this->model_brand->add($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata("sukses", "<small>Brand berhasil disimpan</small>");
                }
                redirect('brand/tambah');
            }
        } else if (isset($_POST['edit'])) {
            $this->form_validation->set_rules('nama_brand', 'Nama Brand', 'required', array('required' => '%s wajib diisi'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_brand');
                $query = $this->model_brand->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('brand') . "';</script>";
                }
            } else {
                if ($this->model_brand->check_brand($post['nama_brand'], $post['id_brand'])->num_rows() > 0) {
                    $this->session->set_flashdata('error', "<small>brand $post[nama_brand] sudah ada.</small>");
                    redirect('brand/edit/' . $post['id_brand']);
                } else {
                    $this->model_brand->edit($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', '<small>Data Brand berhasil diperbaharui.</small>');
                    }
                    redirect('brand');
                }
            }
        }
    }

    public function hapus($id)
    {
        $this->model_brand->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', "<small>Data Brand berhasil dihapus.</small>");
        }
        redirect('brand');
    }
}
