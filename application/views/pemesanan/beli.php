<?php
$ci = get_instance(); // Memanggil object utama 
$ci->load->model('model_jenis'); // Memanggil model_kategori yang terdapat pada model

$jenis = $ci->model_jenis->get($penjualan->id_jenis)->row(); // Menampilkan data kategori berdasarkan id jenis
$kategori = $jenis->nama_kategori;
?>

<!-- Page Add Section Begin -->
<section class="page-add">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="page-breadcrumb">
                    <h2>Checkout<span>.</span></h2>
                </div>
            </div>
            <div class="col-lg-8">
                <img src="img/add.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<!-- Page Add Section End -->

<!-- Cart Total Page Begin -->
<section class="cart-total-page spad">
    <div class="container">
        <form action="<?= site_url('pemesanan/checkout') ?>" class="checkout-form" method="post">
            <input type="hidden" name="id_penjualan" value="<?= $penjualan->id_penjualan ?>">
            <input type="hidden" name="id_toko" value="<?= $penjualan->id_toko ?>">
            <input type="hidden" name="id_pembeli" value="<?= $profil->id_pembeli ?>">
            <input type="hidden" name="tgl_checkout" value="<?= date('Y/m/d') ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Informasi Pembeli</h3>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Nama *</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $profil->nama_pembeli ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Alamat *</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $profil->alamat_pembeli ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Nomor Telp/Hp/WA *</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $profil->telp_pembeli ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Kode Pos *</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $profil->kode_pos ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <h3>Informasi Penjual</h3>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Nama Toko*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $toko->nama_toko ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Alamat Toko*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $toko->alamat_toko ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Nomor Telp Toko*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $toko->no_telp ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Email Toko*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $toko->email_toko ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <h3>Informasi Transaksi</h3>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">ID Transaksi*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" name="id_transaksi" value="<?= $kodetransaksi ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Judul Iklan*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $penjualan->judul ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Kategori*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= ucwords($kategori) ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Jenis Bibit*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= ucwords($penjualan->nama_jenis) ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Harga*</p>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" readonly="" value="<?= $this->fungsi->nominal($penjualan->harga); ?>/<?= $penjualan->satuan ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Jml Beli*</p>
                        </div>
                        <div class="col-lg-5">
                            <input type="text" value="<?= $this->input->post('jlm_beli') ?> <?= $penjualan->satuan ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Total Harga Bayar*</p>
                            <?php
                            $jml = $this->input->post('jlm_beli');
                            $harga = $penjualan->harga;
                            $total = $jml * $harga;
                            ?>
                        </div>
                        <div class="col-lg-5">
                            <input type="text" value="<?= $this->fungsi->nominal($total); ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p class="in-name">Tujuan Transfer*</p>
                        </div>
                        <div class="col-lg-5">
                            <input type="text" value="<?= $toko->nama_bank ?>" readonly>
                        </div>
                        <div class="col-lg-5">
                            <input type="text" value="<?= $toko->no_rek ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="jml_beli" value="<?= $this->input->post('jlm_beli') ?>">
            <input type="hidden" name="total_harga" value="<?= $total ?>">
            <div class="row mt-5">
                <div class="col-lg-12 text-center">
                    <a href="<?= site_url('pemesanan/detail/' . $penjualan->id_penjualan) ?>" class="btn btn-outline-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </form>
    </div>
</section>