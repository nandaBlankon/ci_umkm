<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_produk', 'model_kategori', 'model_usaha']);
        $this->usahaSaya = $this->model_usaha->usahaSaya($this->fungsi->user_login()->user_id)->row();
    }

    public function index()
    {
        $data = array(
            'title'             => 'Produk',
            'row'               => $this->model_produk->get(),
            'act_produk'        => 'active',
            'act_produk1'       => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/data');
        $this->load->view('templates/backend_footer');
    }

    public function tambah()
    {
        $produk = new stdClass;
        $produk->id_produk      = null;
        $produk->id_usaha      = null;
        $produk->id_kategori      = null;
        $produk->judul          = null;
        $produk->deskripsi          = null;
        $produk->harga          = null;
        $produk->stok          = null;
        $produk->satuan          = null;
        $produk->berat          = null;
        $produk->kondisi          = null;
        $produk->id_ukuran          = null;
        $produk->id_warna          = null;
        $produk->slug          = null;

        $query_kategori = $this->model_kategori->get();
        $kategori[null] = '-Pilih Kategori-';
        foreach ($query_kategori->result() as $kat) {
            $kategori[$kat->id_kategori] = ucfirst($kat->nama_kategori);
        }

        $data = array(
            'title'               => 'Produk',
            'page'                => 'tambah',
            'row'                 => $produk,
            'kategori'            => $kategori,
            'selectedkategori'    => null,
            'warna'               => $this->model_produk->warna(),
            'size'                => $this->model_produk->size(),
            'usahaSaya'           => $this->usahaSaya,
            'act_produk'          => 'active',
            'act_produk2'         => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/produk_form');
        $this->load->view('templates/backend_footer');
    }

    public function edit($id)
    {
        $query = $this->model_produk->get($id);

        if ($query->num_rows() > 0) {

            $query_kategori = $this->model_kategori->get();
            $kategori[null] = '-Pilih Kategori-';
            foreach ($query_kategori->result() as $brn) {
                $kategori[$brn->id_kategori] = ucfirst($brn->nama_kategori);
            }

            $produk = $query->row();

            $data = array(
                'title'             => 'Produk',
                'page'                 => 'edit',
                'row'                => $produk,
                'kategori'              => $kategori,
                'selectedkategori'        => $produk->id_kategori,
                'warna'             => $this->model_produk->warna(),
                'size'             => $this->model_produk->size(),
                'usahaSaya'           => $this->usahaSaya,
                'act_produk'        => 'active',
                'act_produk2'        => 'active'
            );
            $this->load->view('templates/backend_header', $data);
            $this->load->view('templates/backend_sidebar');
            $this->load->view('produk/produk_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('produk') . "'</script>";
        }
    }

    // public function proses2()
    // {
    //     $color = $this->input->post('warna'); // menampung data json warna dari form
    //     $size  = $this->input->post('ukuran'); // menampung data json ukuran dari form

    //     // awal dari mengekstrak data json warna
    //     $result = [];
    //     foreach ($color as $key => $val) {

    //         // $result[] = array(
    //         //     'warna'          => $val,
    //         // );
    //         $result[] = array($val);
    //     }
    //     $contact['nama'] = json_encode($result, true);
    //     // akhir dari mengekstrak data json warna

    //     // awal dari mengekstrak data json ukuran
    //     $resultSize = [];
    //     foreach ($size as $key => $valSize) {

    //         $resultSize[] = array($valSize);
    //     }
    //     $contactSize['ukuran'] = json_encode($resultSize, true);
    //     // akhir dari mengekstrak data json warna

    //     $data = array(
    //         'id'    => 1,
    //         'nama'  => $contact['nama'], // kemudian data json di input ke database
    //         'ukuran'  => $contactSize['ukuran'], // kemudian data json di input ke database
    //     );
    //     $update = $this->db->insert('tb_test', $data);

    //     if ($update == true) {
    //         $this->session->set_flashdata('sukses', 'Account has been saved');
    //     }
    //     redirect('produk/tambah');
    // }

    public function proses()
    {
        $post = $this->input->post(null);

        if (isset($_POST['tambah'])) {
            $this->form_validation->set_rules('id_kategori', 'Kategori produk', 'required', array('required' => '%s belum dipilih'));
            $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('deskripsi', 'Deskripsi produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('harga', 'Harga produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('stok', 'Stok produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('satuan', 'Satuan produk', 'required', array('required' => '%s harus diisi'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {
                $this->tambah();
            } else {
                if ($this->model_produk->check_produk($post['judul'], $post['id_produk'])->num_rows() > 0) {

                    $this->session->set_flashdata('error', "<small>Judul produk <u>'" . ucwords($post['judul']) . "'</u> sudah ada");
                    redirect('produk/tambah');
                } else {
                    $post = $this->input->post(null);
                    $this->model_produk->add($post);

                    $color = $this->input->post('warna');
                    $size  = $this->input->post('ukuran');
                    //mendapatkan id produk
                    $idproduk = $this->db->insert_id();
                    foreach ($color as $row) {
                        $data = array(
                            'id_produk' => $idproduk,
                            'id_warna' => $row
                        );
                        $this->db->insert('tb_warna_produk', $data);
                    }

                    foreach ($size as $rowSize) {
                        $data = array(
                            'id_produk' => $idproduk,
                            'id_ukuran' => $rowSize
                        );
                        $this->db->insert('tb_ukuran_produk', $data);
                    }

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata("sukses", "<small>Produk baru berhasil disimpan</small>");
                    }
                    redirect('produk/tambah');
                }
            }
        } else if (isset($_POST['edit'])) {
            $this->form_validation->set_rules('id_kategori', 'Kategori produk', 'required', array('required' => '%s belum dipilih'));
            $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('deskripsi', 'Deskripsi produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('harga', 'Harga produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('stok', 'Stok produk', 'required', array('required' => '%s harus diisi'));
            $this->form_validation->set_rules('satuan', 'Satuan produk', 'required', array('required' => '%s harus diisi'));

            $this->form_validation->set_error_delimiters('<small style="color: gray; margin-bottom: 0;color: red; text-decoration: none;">', '</small>');

            if ($this->form_validation->run() == FALSE) {

                $id = $this->input->post('id_produk');
                $query = $this->model_produk->get($id);

                if ($query->num_rows() > 0) {
                    $this->edit($id);
                } else {
                    echo "<script> alert('Data tidak ditemukan.');";
                    echo "window.location='" . site_url('usaha/usahaSaya') . "';</script>";
                }
            } else {
                if ($this->model_produk->check_produk($post['judul'], $post['id_produk'])->num_rows() > 0) {
                    $this->session->set_flashdata('error', "<small>Judul $post[judul] sudah ada.</small>");
                    redirect('produk/edit/' . $post['id_produk']);
                } else {
                    $this->model_produk->edit($post);

                    $color = $this->input->post('warna');
                    $size = $this->input->post('ukuran');

                    $this->db->delete('tb_warna_produk', array('id_produk' => $post['id_produk']));
                    $this->db->delete('tb_ukuran_produk', array('id_produk' => $post['id_produk']));

                    $result = array();
                    foreach ($color as $key => $val) {
                        $result[] = array(
                            'id_produk'     => $post['id_produk'],
                            'id_warna'      => $_POST['warna'][$key]
                        );
                    }

                    $resultSize = array();
                    foreach ($size as $key => $val) {
                        $resultSize[] = array(
                            'id_produk'     => $post['id_produk'],
                            'id_ukuran'     => $_POST['ukuran'][$key]
                        );
                    }

                    //MULTIPLE INSERT TO DETAIL TABLE
                    $this->db->insert_batch('tb_warna_produk', $result);
                    $this->db->insert_batch('tb_ukuran_produk', $resultSize);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', '<small>Data produk berhasil diperbaharui.</small>');
                    }
                    redirect('usaha/usahaSaya');
                }
            }
        }
    }

    public function uploadFoto($id)
    {
        $produk = $this->model_produk->get($id)->row();

        $uploadfoto = new stdClass;
        $uploadfoto->id_image        = null;
        $uploadfoto->id_produk        = null;
        $uploadfoto->image             = null;

        $data = array(
            'title'         => 'Produk',
            'page'             => 'tambah',
            'row'            => $uploadfoto,
            'produk'        => $produk,
            'usahaSaya'           => $this->usahaSaya,
            'act_produk'    => 'active',
            'act_produk2'   => 'active',
        );

        $this->load->view('templates/backend_header', $data);
        $this->load->view('templates/backend_sidebar');
        $this->load->view('produk/uploadfoto_form');
        $this->load->view('templates/backend_footer');
    }

    public function editfoto($id)
    {
        $query = $this->model_produk->imageById($id);

        if ($query->num_rows() > 0) {
            $image = $query->row();
            $data = array(
                'title'     => 'Produk',
                'page'         => 'edit',
                'row'        => $image,
                'usahaSaya'           => $this->usahaSaya,
                'act_produk'    => 'active',
                'act_produk2' => 'active',
            );

            $this->load->view('templates/backend_header', $data);
            $this->load->view('templates/backend_sidebar');
            $this->load->view('produk/uploadfoto_form');
            $this->load->view('templates/backend_footer');
        } else {
            echo "<script>alert('Data tidak ditemukan.');</script>";
            echo "<script>window.location='" . site_url('usaha/usahaSaya') . "'</script>";
        }
    }

    public function prosesfoto()
    {
        $config['upload_path']        = './uploads/produk/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']            = 2048;
        $config['file_name']        = 'ip-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);

        if (isset($_POST['tambah'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $post['image'] = $this->upload->data('file_name');
                    $this->model_produk->addFoto($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Foto produk berhasil diunggah.');
                    }
                    redirect('produk/uploadfoto/' . $post['id_produk']);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('produk/uploadfoto/' . $post['id_produk']);
                }
            } else {
                $post['image'] = null;
                $this->model_produk->addFoto($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('sukses', 'Foto produk berhasil diunggah.');
                }
                redirect('produk/uploadfoto/' . $post['id_produk']);
            }
        } else if (isset($_POST['edit'])) {
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {

                    $produk = $this->model_produk->imageById($post['id_image'])->row();
                    if ($produk->image != null) {
                        $target_file = './uploads/produk/' . $produk->image;
                        unlink($target_file);
                    }

                    $post['image'] = $this->upload->data('file_name');
                    $this->model_produk->editFoto($post);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('sukses', 'Foto produk berhasil diganti.');
                    }
                    redirect('usaha/usahaSaya');
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('produk/editfoto/' . $post['id_image']);
                }
            } else {
                $post['image'] = null;
                $this->model_produk->editFoto($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('sukses', 'Foto produk berhasil diganti.');
                }
                redirect('usaha/usahaSaya');
            }
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil disimpan.');</script>";
        }
        echo "<script>window.location='" . site_url('usaha/usahaSaya') . "'</script>";
    }

    public function hapusfoto($id)
    {
        $berkas = $this->model_produk->getImage($id)->row();
        if ($berkas->image != null) {
            $target_file = './uploads/produk/' . $berkas->image;
            unlink($target_file);
        }

        $this->model_produk->delFoto($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Foto produk berhasil dihapus.');</script>";
        }
        echo "<script>window.location='" . site_url('usaha/usahaSaya') . "'</script>";
    }

    public function hapus($id)
    {
        $this->model_produk->del($id);
        $this->model_produk->delWarna($id);
        $this->model_produk->delSize($id);

        $berkas = $this->model_produk->getImage($id)->row();
        if ($berkas->image != null) {
            $target_file = './uploads/produk/' . $berkas->image;
            unlink($target_file);
        }
        $this->model_produk->delFoto($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', "<small>Data produk berhasil dihapus.</small>");
        }
        redirect('usaha/usahaSaya');
    }
}
