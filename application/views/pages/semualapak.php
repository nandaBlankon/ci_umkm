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
                            JUMLAH DATA LAPAK YANG TERDAFTAR DI BUKATAPLAK: <?= $jumlah; ?> LAPAK
                        </label>
                    </div>
                    <!-- <div class="store-sort">
                    </div> -->
                    <ul class="store-grid">
                        <li class="active"><a href="<?= site_url('') ?>" style="color: white;" title="Halaman Utama Bukataplak"><i class="fa fa-home"></i></a></li>
                        <!-- <li><a href="#"><i class="fa fa-th-list"></i></a></li> -->
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    <?php foreach ($penjual->result() as $penjual) : ?>

                        <div class="col-md-6 col-xs-6">
                            <div class="product">
                                <div class="product-img">

                                    <?php if ($penjual->image != null) { ?>
                                        <img src="<?= base_url('uploads/penjual/' . $penjual->image) ?>" alt="<?= $penjual->nama; ?>" style="height: 220px;">
                                    <?php } else { ?>
                                        <img src="<?= base_url('uploads/logotoko.jpg') ?>" style="height: 220px;">
                                    <?php } ?>

                                    <div class="product-label">
                                        <!-- <span class="sale">-30%</span> -->
                                        <span class="new">Buka</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">NAMA LAPAK</p>
                                    <h3 class="product-name"><a href="<?= site_url('lapak/' . $penjual->id_penjual) ?>"><?= $penjual->nama; ?></a></h3>
                                    <h4 class="product-price"><?= $penjual->alamat; ?> </h4>
                                    <div class="product-rating">

                                    </div>
                                    <p>
                                        <a href="" class=" text-bold"><i class="fa fa-phone"></i> Telp: <?= $penjual->no_telp; ?></a>
                                    </p>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-archive"></i> Kunjungi</button>
                                </div>
                            </div>
                        </div>
                        <!-- /product -->
                    <?php endforeach ?>

                    <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <!-- <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products </span>
                    <ul class="store-pagination">
                        <li class="active"></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div> -->
                <!-- /store bottom filter -->
                <?php echo $pagination ?>
            </div>
            <!-- /STORE -->

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->