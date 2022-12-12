<!-- Main Section-->
<section class="mt-5 ">
    <!-- Page Content Goes Here -->

    <!-- Product Top-->
    <section class="container">

        <!-- Breadcrumbs-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(''); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="#"><?= $produk->nama_kategori; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $produk->judul; ?></li>
            </ol>
        </nav> <!-- /Breadcrumbs-->

        <div class="row g-5">

            <!-- Images Section-->
            <div class="col-12 col-lg-7">
                <div class="row g-1">
                    <div class="swiper-container gallery-thumbs-vertical col-2 pb-4">
                        <div class="swiper-wrapper">
                            <!-- menampilkan foto produk berdasarkan id_produk -->
                            <?php
                            $image = $this->db->query("select * from tb_image_produk where id_produk='$produk->id_produk' order by id_image");
                            foreach ($image->result() as $foto) :
                            ?>
                                <div class="swiper-slide bg-light bg-light h-auto">
                                    <picture>
                                        <img class="img-fluid mx-auto d-table" src="<?= base_url('uploads/produk/' . $foto->image); ?>" alt="">
                                    </picture>
                                </div>
                            <?php endforeach ?>
                            <!-- menampilkan foto produk berdasarkan id_produk -->
                        </div>
                    </div>
                    <div class="swiper-container gallery-top-vertical col-10">
                        <div class="swiper-wrapper">
                            <!-- menampilkan foto produk berdasarkan id_produk -->
                            <?php
                            $image = $this->db->query("select * from tb_image_produk where id_produk='$produk->id_produk' order by id_image");
                            foreach ($image->result() as $foto) :
                            ?>
                                <div class="swiper-slide bg-white h-auto">
                                    <picture>
                                        <img class="img-fluid d-table mx-auto" src="<?= base_url('uploads/produk/' . $foto->image); ?>" alt="" data-zoomable>
                                    </picture>
                                </div>
                            <?php endforeach ?>
                            <!-- menampilkan foto produk berdasarkan id_produk -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Images Section-->

            <!-- Product Info Section-->
            <div class="col-12 col-lg-5">
                <div class="pb-3">

                    <!-- Product Name, Review, Brand, Price-->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="small fw-bolder text-uppercase tracking-wider text-muted mb-0 lh-1"><?= $produk->nama_kategori; ?></p>

                    </div>
                    <h1 class="mb-2 fs-2 fw-bold"><?= $produk->judul; ?></h1>
                    <div class="d-flex justify-content-start align-items-center">
                        <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2"><?= $this->fungsi->nominal($produk->harga) ?></p>
                    </div>
                    <!-- /Product Name, Review, Brand, Price-->

                    <!-- Product Views-->
                    <div class="d-flex justify-content-start mt-3">
                        <div class="alert bg-light rounded py-1 px-2 d-table m-0">
                            <table>
                                <tr>
                                    <td>
                                        <?php if ($produk->berat) : ?>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <i class="ri-fire-fill lh-1 text-orange"></i>
                                                <div class="ms-2">
                                                    <small class="opacity-75 fw-bolder lh-1">Berat <?= $produk->berat; ?> Gram</small>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($produk->kondisi) : ?>
                                            <div class="d-flex justify-content-start align-items-center ml-3">
                                                <i class="ri-fire-fill lh-1 text-orange"></i>
                                                <div class="ms-2">
                                                    <small class="opacity-75 fw-bolder lh-1">Kondisi <?= $produk->kondisi; ?></small>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /Product Views-->
                    <form action="<?= site_url('welcome/tambah') ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $produk->id_produk ?>">
                        <!-- Product Options-->
                        <div class="border-top mt-4 mb-3">
                            <div class="product-option mb-4 mt-4">
                                <!-- menampilkan warna produk berdasarkan id_produk -->
                                <?php
                                $warna = $this->db->query("select * from tb_warna_produk,tb_warna where tb_warna_produk.id_warna=tb_warna.id_warna and id_produk='$produk->id_produk' order by id ASC");
                                if ($warna->num_rows()) :
                                ?>
                                    <div class="product-option">
                                        <small class="text-uppercase d-block fw-bolder mb-2">
                                            Color (warna) : <span class="selected-option fw-bold"></span>
                                        </small>
                                        <div class="form-group">
                                            <select name="warna" class="form-control" data-choices required>
                                                <option value="">Please Select Color</option>
                                                <?php foreach ($warna->result() as $color) : ?>
                                                    <option value="<?= $color->warna; ?>"><?= $color->warna; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <!-- menampilkan ukuran produk berdasarkan id_produk -->
                                <?php
                                $ukuran = $this->db->query("select * from tb_ukuran_produk,tb_ukuran where tb_ukuran_produk.id_ukuran=tb_ukuran.id_ukuran and id_produk='$produk->id_produk' order by id ASC");
                                if ($ukuran->num_rows()) :
                                ?>
                                    <div class="product-option">
                                        <small class="text-uppercase d-block fw-bolder mb-2">
                                            Size (ukuran) : <span class="selected-option fw-bold"></span>
                                        </small>
                                        <div class="form-group">
                                            <select name="ukuran" class="form-control" data-choices required>
                                                <option value="">Please Select Size</option>
                                                <?php foreach ($ukuran->result() as $size) : ?>
                                                    <option value="<?= $size->ukuran; ?>"><?= $size->ukuran; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                            <!-- /Product Options-->

                            <!-- Add To Cart-->
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="number" class="" name="qty" value="1" min="0" max="<?= $produk->stok; ?>">
                                        <?= $produk->stok; ?> tersisa
                                        <?php if ($this->session->userdata('user_id')) { ?>
                                            <button class="btn-dark text-white" type="submit">Tambah Ke Keranjang</button>
                                        <?php } else { ?>
                                            <a class="btn btn-sm btn-dark text-white" type="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Ke Keranjang</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /Add To Cart-->

                            <!-- Socials-->
                            <div class="my-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <p class="fw-bolder lh-1 mb-0 me-3">Share</p>
                                    <ul class="list-unstyled p-0 m-0 d-flex justify-content-start lh-1 align-items-center mt-1">
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i class="ri-facebook-box-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i class="ri-instagram-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i class="ri-pinterest-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i class="ri-twitter-fill"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Socials-->

                            <!-- Special Offers-->
                            <!-- <div class="bg-light rounded py-2 px-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex border-0 px-0 bg-transparent">
                                    <i class="ri-truck-line"></i>
                                    <span class="fs-6 ms-3">Standard delivery free for orders over $99. Next day delivery $9.99</span>
                                </li>
                            </ul>
                        </div> -->
                            <!-- /Special Offers-->

                        </div>
                    </form>
                </div>
                <!-- / Product Info Section-->
            </div>
    </section>
    <!-- / Product Top-->

    <section>

        <!-- Product Tabs-->
        <div class="mt-7 pt-5 border-top">
            <div class="container">
                <!-- Tab Nav-->
                <ul class="nav justify-content-center nav-tabs nav-tabs-border mb-4" id="myTab" role="tablist">
                    <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                        <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0 active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Detail Produk</a>
                    </li>
                    <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                        <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0" id="delivery-tab" data-bs-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">Pengiriman</a>
                    </li>
                </ul>
                <!-- / Tab Nav-->

                <!-- Tab Content-->
                <div class="tab-content" id="myTabContent">

                    <!-- Tab Details Content-->
                    <div class="tab-pane fade show active py-5" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="col-12 col-lg-10 mx-auto">
                            <div class="row g-5">
                                <div class="col-12 col-md-12">
                                    <p><?= $produk->deskripsi; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Tab Details Content-->

                    <!-- Delivery Tab Content-->
                    <div class="tab-pane fade py-5" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto">
                            <?php $usaha = $this->db->query("select * from tb_usaha where id_usaha='$produk->id_usaha'")->row(); ?>
                            <p>Produk di kirim dari <?= ucfirst($usaha->alamat_usaha); ?> Desa <?= ucfirst($usaha->desa); ?> Kecamatan <?= ucfirst($usaha->kecamatan); ?> Kabupaten <?= ucfirst($usaha->kabupaten); ?>. Produk akan dikirim segera setelah proses pembayaran selesai. Pengiriman produk paling lambat dua hari setelah proses pembayaran selesai. Terimakasih!</p>
                        </div>
                    </div>
                    <!-- / Delivery Tab Content-->

                </div>
                <!-- / Tab Content-->
            </div>
        </div>
        <!-- / Product Tabs-->

    </section>

    <!-- /Page Content -->
</section>
<!-- / Main Section-->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hai, terima kasih sudah mengunjungi situs kami.
                Namun untuk melakukan Transaksi, anda harus login terlebih dahulu!!
                <p>
                <div class="btn-group" role="group">
                    <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary">Masuk</a>
                    <a href="<?= site_url('daftar') ?>" class="btn btn-sm btn-danger">Daftar</a>
                </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>