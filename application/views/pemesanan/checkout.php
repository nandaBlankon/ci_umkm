<!-- Main Section-->
<section class="mt-5 container ">
    <!-- Page Content Goes Here -->

    <h1 class="mb-4 display-5 fw-bold text-center">Checkout dengan Aman</h1>
    <p class="text-center mx-auto">Silakan isi detail di bawah ini untuk menyelesaikan pesanan Anda.</p>
    <?php
    $cart = $this->cart->contents();
    if (empty($cart)) {
    ?>
        <div class="d-flex flex-column justify-content-between w-100 h-100">
            Keranjang belanja anda kosong.
        </div>
    <?php } else { ?>
        <div class="row g-md-8 mt-4">
            <!-- Checkout Panel Left -->
            <div class="col-12 col-lg-6 col-xl-7">
                <!-- Checkout Shipping Address -->
                <div class="checkout-panel">
                    <h5 class="title-checkout">Alamat pengiriman</h5>
                    <div class="row">

                        <?php if (empty($profil)) { ?>
                            <!-- Special Offers-->
                            <div class="col-md-12">
                                <div class="bg-light rounded py-2 px-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex border-0 px-0 bg-transparent">
                                            <i class="ri-truck-line"></i>
                                            <span class="fs-6 ms-3">
                                                Profil anda belum lengkap, untuk melanjutkan proses pemesanan ini anda harus
                                                melengkapi profil anda terlebih dahulu.
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <center><a class="btn btn-outline-dark mt-3" href="<?= site_url('dashboard') ?>">Lengkapi Profil</a></center>
                            </div>
                            <!-- /Special Offers-->
                        <?php } else { ?>
                            <!-- First Name-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">Nama lengkap</label>
                                    <input type="text" class="form-control" value="<?= $this->fungsi->user_login()->nama; ?>" readonly>
                                </div>
                            </div>

                            <!-- Last Name-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="<?= $this->fungsi->user_login()->username; ?>" readonly>
                                </div>
                            </div>
                            <!-- Address-->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="<?= $profil->alamat; ?>" readonly>
                                </div>
                            </div>

                            <!-- State-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">No Telp/wa</label>
                                    <input type="text" class="form-control" value="<?= $profil->no_telp; ?>" readonly>
                                </div>
                            </div>

                            <!-- Post Code-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Desa</label>
                                    <input type="text" class="form-control" value="<?= $profil->desa; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" value="<?= $profil->kecamatan; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Kabupaten</label>
                                    <input type="text" class="form-control" value="<?= $profil->kabupaten; ?>" readonly>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- /Checkout Shipping Address -->
            </div>
            <!-- / Checkout Panel Left -->
            <!-- Checkout Panel Summary -->
            <div class="col-12 col-lg-6 col-xl-5">
                <form action="<?= site_url('welcome/prosescheckout') ?>" method="POST">

                    <div class="bg-light p-4 sticky-md-top top-5">
                        <div class="border-bottom pb-3">
                            <?php
                            $no = 1;
                            $grand_total = 0;
                            foreach ($cart as $item) :
                                $grand_total += $item['subtotal'];
                                $produk = $this->db->query("select * from tb_produk where id_produk='$item[id]'")->row();
                                $usaha = $this->db->query("select * from tb_usaha where id_usaha='$produk->id_usaha'")->row();
                            ?>
                                <input type="hidden" name="id_pembeli" value="<?= $profil->user_id ?>">
                                <input type="hidden" name="id_penjual" value="<?= $usaha->user_id ?>">
                                <input type="hidden" name="id_produk" value="<?= $produk->id_produk ?>">
                                <input type="hidden" name="warna" value="<?= $item['color']; ?>">
                                <input type="hidden" name="ukuran" value="<?= $item['size']; ?>">
                                <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                                <!-- Cart Item-->
                                <div class="d-none d-md-flex justify-content-between align-items-start py-2">
                                    <div class="d-flex flex-grow-1 justify-content-start align-items-start">
                                        <div class="position-relative f-w-20 border p-2 me-4">
                                            <span class="checkout-item-qty"><?= $item['qty']; ?></span>
                                            <img src="<?= base_url('uploads/produk/' . $item['image']) ?>" class="rounded img-fluid">
                                        </div>
                                        <div>
                                            <p class="mb-1 fs-6 fw-bolder"><?= ucwords(str_replace('-', ' ', $item['name'])); ?></p>
                                            <span class="fs-xs text-uppercase fw-bolder text-muted">Jml Pesan <?= $item['qty']; ?> <?= $produk->satuan; ?>, Harga/<?= $produk->satuan; ?> <?= number_format($item['price'], 0, ",", ".") ?></span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 fw-bolder">
                                        <span><?= number_format($item['subtotal'], 0, ",", ".") ?></span>
                                    </div>
                                </div>
                                <!-- / Cart Item-->
                            <?php endforeach ?>
                        </div>
                        <div class="py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="m-0 fw-bold fs-5">Grand Total</p>
                                </div>
                                <p class="m-0 fs-5 fw-bold"><?= number_format($this->cart->total(), 0, ",", "."); ?></p>
                            </div>
                        </div>
                        <!-- Accept Terms Checkbox-->
                        <div class="form-group form-check my-4">
                            <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                            <label class="form-check-label fw-bolder" for="accept-terms">Saya setuju dengan <a href="#">syarat & ketentuan</a></label>
                        </div>
                        <?php if (empty($profil)) { ?>
                            <button type="submit" class="btn btn-dark w-100" role="button" disabled>Selesaikan Pesanan</button>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-dark w-100" role="button">Selesaikan Pesanan</button>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <!-- /Checkout Panel Summary -->
        </div>
    <?php } ?>
    <!-- /Page Content -->
</section>
<!-- / Main Section-->