<!-- Main Section-->
<section class="mt-0 ">

    <!-- Category Top Banner -->
    <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center">
        <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item breadcrumb-light"><a href="#">Home</a></li> -->
                    <!-- <li class="breadcrumb-item breadcrumb-light"><a href="#">Activities</a></li>
                    <li class="breadcrumb-item active breadcrumb-light" aria-current="page">Clothing</li> -->
                </ol>
            </nav>
            <h1 class="fw-bold display-6 mb-4 text-white"><?php echo $this->config->item('nama_aplikasi'); ?></h1>
            <!-- <div class="col-12 col-md-6">
                <p class="lead text-white mb-0">
                    Move, stretch, jump and hike in our latest waterproof arrivals. We've got you covered for your
                    hike or climbing sessions, from Gortex jackets to lightweight waterproof pants. Discover our
                    latest range of outdoor clothing.
                </p>
            </div> -->
        </div>
    </div>
    <!-- Category Top Banner -->

    <div class="container">

        <div class="row">

            <!-- Category Aside/Sidebar -->
            <div class="d-none d-lg-flex col-lg-3">
                <div class="pe-4">
                    <!-- Category Aside -->
                    <aside>

                        <!-- Filter Category -->
                        <div class="mb-4">
                            <h2 class="mb-4 fs-6 mt-2 fw-bolder">Daftar Penjual</h2>
                            <nav>
                                <ul class="list-unstyled list-default-text">

                                    <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="<?= base_url('seller/umkm'); ?>"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> UMKM</span> <span class="text-muted ms-4">(<?= $umkm->num_rows(); ?>)</span></a>
                                    </li>

                                    <li class="mb-2"><a class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center" href="<?= base_url('seller/homeIndustri'); ?>"><span><i class="ri-arrow-right-s-line align-bottom ms-n1"></i> Home Industri</span> <span class="text-muted ms-4">(<?= $homeIndustri->num_rows(); ?>)</span></a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <!-- / Filter Category-->

                        <!-- Brands Filter -->
                        <div class="py-4 widget-filter border-top">
                            <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron" data-bs-toggle="collapse" href="#filter-brands" role="button" aria-expanded="true" aria-controls="filter-brands">
                                Kategori Produk
                            </a>
                            <div id="filter-brands" class="collapse show">
                                <div class="input-group my-3 py-1">
                                    <input type="text" class="form-control py-2 filter-search rounded" placeholder="Search" aria-label="Search">
                                    <span class="input-group-text bg-transparent px-2 position-absolute top-7 end-0 border-0 z-index-20"><i class="ri-search-2-line text-muted"></i></span>
                                </div>
                                <div class="simplebar-wrapper">
                                    <div class="filter-options" data-pixr-simplebar>
                                        <?php foreach ($kategori->result() as $cat) : ?>
                                            <div class="form-group form-check mb-0">
                                                <a href="<?= base_url('category/' . $cat->slug); ?>">
                                                    <span class="form-check-input"></span>
                                                    <label class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between" for="filter-brand-0"><?= ucfirst($cat->nama_kategori); ?></label>
                                                </a>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Brands Filter -->

                    </aside>
                    <!-- / Category Aside-->
                </div>
            </div>
            <!-- / Category Aside/Sidebar -->

            <!-- Category Products-->
            <div class="col-12 col-lg-9">

                <!-- Products-->
                <div class="row g-4 mb-5">
                    <?php
                    foreach ($produk->result() as $data) :
                        $image = $this->db->query("select * from tb_image_produk where id_produk='$data->id_produk' order by id_image LIMIT 1");
                    ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <!-- Card Product-->
                            <div class="card position-relative h-100 card-listing hover-trigger">
                                <?php if ($data->kondisi == true) : ?>
                                    <span class="badge card-badge bg-primary">
                                        <?= $data->kondisi; ?>
                                    </span>
                                <?php endif ?>
                                <div class="card-header">
                                    <picture class="position-relative overflow-hidden d-block bg-light">
                                        <?php
                                        if ($image->num_rows()) {
                                            foreach ($image->result() as $foto) :
                                        ?>
                                                <img class="w-100 img-fluid position-relative z-index-10" title="" src="<?= base_url('uploads/produk/' . $foto->image); ?>" style="height: 330px;">
                                            <?php endforeach ?>
                                            <!-- endforeach foto -->
                                        <?php } else { ?>
                                            <img class="w-100 img-fluid position-relative z-index-10" title="" src="<?= base_url('assets/frontend/dist/'); ?>assets/images/products/product-3.jpg" alt="">
                                        <?php } ?>
                                    </picture>
                                    <div class="card-actions">
                                        <span class="small text-uppercase tracking-wide fw-bolder text-center d-block"><?= $data->nama_kategori; ?></span>
                                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                                            <!-- <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                                            <button class="btn btn-outline-dark btn-sm mx-2">L</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 text-center">
                                    <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                        <!-- Review Stars Small-->
                                        <span class="small fw-bolder ms-2 text-muted">Sisa <?= $data->stok; ?> <?= $data->satuan; ?></span>
                                    </div>
                                    <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center" href="<?= base_url('product/' . $data->slug_produk); ?>"><?= ucfirst($data->judul); ?></a>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <p class="mb-0 me-2 text-danger fw-bolder"><span><?= $this->fungsi->nominal($data->harga) ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Card Product-->
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
            <!-- / Products-->

            <?php echo $pagination; ?>


        </div>
        <!-- / Category Products-->

    </div>
    </div>

</section>
<!-- / Main Section-->