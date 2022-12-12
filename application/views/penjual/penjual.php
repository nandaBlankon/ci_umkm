<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="active"><?= $title; ?> <?= $penjual->nama; ?></li>
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

            <div class="col-md-12">
                <!-- product -->
                <div class="product">
                    <div class="product-img">
                        <?php if ($penjual->image != null) { ?>
                            <img src="<?= base_url('uploads/penjual/' . $penjual->image) ?>" style="height: 320px;">
                        <?php } else { ?>
                            <img src="<?= base_url('uploads/logotoko.jpg') ?>" style="height: 320px;">
                        <?php } ?>
                        <div class="product-label">
                            <span class="new">LAPAK AKTIF</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#"></a></h3>
                        <h4 class="product-price"><?= $penjual->nama; ?></h4>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-btns">
                            <i class="fa fa-map-marker"></i> <?= $penjual->alamat; ?> |
                            <i class="fa fa-phone"></i> <?= $penjual->no_telp; ?> |
                            <i class="fa fa-envelope-o"></i> <?= $penjual->email; ?> |
                        </div>
                    </div>
                </div>
                <!-- /product -->
            </div>

            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Etalase Lapak</h3>
                    <div class="checkbox-filter">

                        <?php foreach ($penjualan as $merk) : ?>
                            <div class="input-checkbox">
                                <i class="fa fa-mobile-phone fa-2x"></i>
                                <label for="category-1">
                                    <span></span>
                                    <?= $merk->nama_merk; ?>
                                    <!-- <small>(120)</small> -->
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
                    <div class="store-sort">
                        <label>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="input" placeholder="Cari produk dilapak ini">
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    <!-- <input class="input" type="submit" value="CARI"> -->
                                    , <button type="submit" class="primary-btn order-submit">CARI</button>
                                </div>
                            </form>
                        </label>
                    </div>
                    <ul class="store-grid">
                        <li class="active"><a href="<?= site_url('') ?>" style="color: white;" title="Halaman Utama Bukataplak"><i class="fa fa-home"></i></a></li>
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    <?php foreach ($penjualan as $penjualan) : ?>
                        <?php
                        $query = $this->db->query("select * from tb_image where id_penjualan='$penjualan->id_penjualan' order by id_image ASC LIMIT 1");
                        ?>
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
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
                                    <h4 class="product-price"><?= $this->fungsi->nominal($penjualan->harga) ?> </h4>
                                    <div class="product-rating">

                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-money"></i><span class="tooltipp">Beli Sekarang</span></button>
                                        <!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> -->
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                </div>
                            </div>
                        </div>
                        <!-- /product -->
                    <?php endforeach ?>

                    <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->