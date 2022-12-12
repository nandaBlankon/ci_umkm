<!-- Main Section-->
<section class="mt-0 ">

    <!-- Category Top Banner -->
    <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center">
        <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">

            <h1 class="fw-bold display-6 mb-4 text-white">Home >> <?= $title; ?></h1>

        </div>
    </div>
    <!-- Category Top Banner -->

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php $this->view('messages') ?>
            </div>
            <div class="col-md-6">
                <div class="bg-dark p-4 p-md-5 text-white">
                    <h3 class="fs-3 fw-bold m-0 text-center">Baru di Marketplace kami?</h3>

                    <div class="py-3 border-bottom-white-opacity">
                        <div class="text-center">
                            Bergabung sekarang juga, temukan ribuan produk lokal UMKM dan Home Industri dari seluruh Provinsi Aceh di sini.
                        </div>
                    </div>

                    <!-- Checkout Button-->
                    <a href="<?= base_url('daftar'); ?>" class="btn btn-white w-100 text-center mt-3" role="button"><i class="ri-secure-payment-line align-bottom"></i> Buat Sebuah Akun</a>
                    <!-- Checkout Button-->
                </div>

            </div>

            <div class="col-md-6">
                <div class="bg-dark p-4 p-md-5 text-white">
                    <h3 class="fs-3 fw-bold m-0 text-center border-bottom-white-opacity">Masuk</h3>

                    <div class="py-3">
                        <form class="row contact_form" action="<?= site_url('welcome/loginproses') ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" required name="username" value="<?= set_value('username') ?>" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" required id="password" name="password" value="<?= set_value('password') ?>" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" class="btn btn-orange w-100 text-center mt-3" role="button">
                                    Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

</section>