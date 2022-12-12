<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="active"><?= $title; ?></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Merk Produk</h3>
                    <div class="checkbox-filter">

                        <?php foreach ($merk as $merk) : ?>
                            <div class="input-checkbox">
                                <i class="fa fa-mobile-phone fa-2x"></i>
                                <label for="">
                                    <span></span>
                                    <a href="<?= site_url('merk/' . $merk->id_merk) ?>"><?= $merk->nama_merk; ?></a>
                                    <!-- <small>(120)</small> -->
                                </label>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Lapak Penjual</h3>
                    <div class="checkbox-filter">

                        <?php foreach ($penjual as $penjual) : ?>
                            <div class="input-checkbox">
                                <i class="fa fa-archive"></i>
                                <label for="brand-1">
                                    <span></span>
                                    <a href="<?= site_url('penjual/' . $penjual->id_penjual) ?>"><?= $penjual->nama; ?></a>
                                    <!-- <small>(578)</small> -->
                                </label>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <!-- <div class="store-sort">
                        <label>
                            Sort By:
                            <select class="input-select">
                                <option value="0">Produk Baru</option>
                                <option value="1">Produk Bekas</option>
                            </select>
                        </label>
                    </div> -->
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                JUMLAH PRODUK YANG ADA DI BUKATAPLAK: <?= $jumlah; ?> PRODUK
                            </label>
                        </div>
                        <!-- <div class="store-sort">
                    </div> -->
                        <ul class="store-grid">
                            <li class="active"><a href="<?= site_url('') ?>" style="color: white;" title="Halaman Utama Bukataplak"><i class="fa fa-home"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-th-list"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    <?php foreach ($penjualan->result() as $penjualan) : ?>
                        <?php
                        $query = $this->db->query("select * from tb_image where id_penjualan='$penjualan->id_penjualan' order by id_image ASC LIMIT 1");
                        ?>
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <form action="<?= site_url('welcome/tambah') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $penjualan->id_penjualan ?>">
                                    <div class="product-img">
                                        <?php
                                        if ($query->num_rows()) {
                                            foreach ($query->result() as $key => $image) :
                                        ?>
                                                <img src="<?= base_url('uploads/image/' . $image->image) ?>" style="height: 230px;">
                                            <?php endforeach ?>
                                        <?php } else { ?>
                                            <img src="<?= base_url('assets/img/product07.png') ?>" alt="">
                                        <?php } ?>
                                        <div class="product-label">
                                            <!-- <span class="sale">-30%</span> -->
                                            <span class="new"><?= $penjualan->kondisi; ?></span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?= $penjualan->nama_merk; ?></p>
                                        <h3 class="product-name"><a href="<?= site_url('produk/' . $penjualan->id_penjualan) ?>"><?= $penjualan->judul; ?></a></h3>
                                        <!-- <h3 class="product-name"><a href="<?= site_url(url_title($penjualan->judul, 'dash', true)) ?>"><?= $penjualan->judul; ?></a></h3> for slug-->
                                        <h4 class="product-price"><?= $this->fungsi->nominal($penjualan->harga) ?> </h4>
                                        <div class="product-rating">
                                            <!-- <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> -->
                                            Tersedia <?= $penjualan->stok; ?> stok barang
                                        </div>
                                        <p>
                                            <a href="" class=" text-bold"><i class="fa fa-gift"></i> <?= $penjualan->nama_lapak; ?></a>
                                        </p>
                                        <div class="product-btns">
                                            <?php if ($this->session->userdata('user_id')) { ?>
                                                <!-- menampilkan warna produk berdasarkan id_penjualan -->
                                                <?php
                                                $query = $this->db->query("select * from tb_penjualan_warna,tb_warna where tb_penjualan_warna.id_warna=tb_warna.id_warna and id_penjualan='$penjualan->id_penjualan' order by id ASC");
                                                ?>
                                                <!-- end menampilkan warna produk berdasarkan id_penjualan -->
                                                <select class="form-control form-control-sm" name="color" required oninvalid="this.setCustomValidity('Pilih warna produk dulu')" oninput="this.setCustomValidity('')">
                                                    <option value=""><span><strong>--pilih warna--</strong></span></option>
                                                    <?php foreach ($query->result() as $warna) : ?>
                                                        <option value="<?= $warna->warna; ?>"><?= $warna->warna; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <!-- <button class="add-to-wishlist"><a href="<?= site_url('welcome/tambah/' . $penjualan->id_penjualan) ?>"><i class="fa fa-money"></i></a><span class="tooltipp">Beli Sekarang</span></button> -->
                                            <?php } else { ?>
                                                <button class="add-to-wishlist"><a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-money"></i></a><span class="tooltipp">Beli Sekarang</span></button>
                                            <?php } ?>
                                            <!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> -->
                                            <!-- <button class="quick-view"><a href="<?= site_url('produk/' . $penjualan->id_penjualan) ?>"><i class="fa fa-eye"></i></a><span class="tooltipp">Lihat produk ini</span></button> -->
                                            <br>
                                            <p><a href="<?= site_url('produk/' . $penjualan->id_penjualan) ?>" class="tooltipp"><i class="fa fa-eye"></i> <span>Lihat Produk</span></a></p>
                                        </div>

                                    </div>
                                    <div class="add-to-cart">
                                        <?php if ($this->session->userdata('user_id')) { ?>
                                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                        <?php } else { ?>
                                            <button type="button" class="add-to-cart-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /product -->
                    <?php endforeach ?>

                    <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>

                </div>
                <!-- /store products -->

                <?php echo $pagination ?>
            </div>
            <!-- /STORE -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pemberitahuan</h4>
            </div>
            <div class="modal-body">
                <p>Anda harus login dulu untuk melakukan transaksi di Bukataplak.</p>
                <p>Sudah punya akun ? </p>
                <p>
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="<?= site_url('login') ?>" class="btn btn-default">Masuk</a>
                        <a href="<?= site_url('daftar') ?>" class="btn btn-danger">Daftar</a>
                    </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>