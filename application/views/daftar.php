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
                    <h3 class="fs-3 fw-bold m-0 text-center border-bottom-white-opacity">Informasi</h3>

                    <div class="py-3 border-bottom-white-opacity">
                        <div class="text-center">
                            <p>Dengan mendaftar, saya menyetujui <br>
                                <a href="#" class="text-white"> Syarat dan Ketentuan</a> serta <a href="#" class="text-white"> Kebijakan Privasi</a>.
                            </p>
                            <p>Temukan ribuan produk lokal UMKM dan Home Industri dari seluruh Provinsi Aceh di sini.
                                Kamu juga bisa memasarkan produk mu dengan gratis.
                            </p>
                            <p>Daftar Sekarang Juga.</p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <div class="bg-dark p-4 p-md-5 text-white">
                    <h3 class="fs-3 fw-bold m-0 text-center border-bottom-white-opacity">Daftar Sekarang</h3>

                    <div class="py-3">
                        <form action="<?= site_url('welcome/register') ?>" method="POST">
                            <input type="hidden" name="kodeunik" value="<?= $kodeunik ?>">
                            <div class="form-group">
                                <input type="text" name="nama" placeholder="Nama Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Lengkap'" class="form-control">
                                <?= form_error('nama') ?>
                            </div>
                            <div class="form-group">
                                <select name="jekel" id="jekel" class="form-control">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <?= form_error('jekel') ?>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Aktif" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Aktif'" class="form-control">
                                <?= form_error('email') ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="form-control">
                                <?= form_error('password') ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="passconf" placeholder="Ulangi Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ulangi Password'" class="form-control">
                                <?= form_error('passconf') ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" class="btn btn-orange w-100 text-center mt-3" role="button">
                                    Daftar
                                </button>
                            </div>
                        </form>
                        <p class="text-white">Sudah punya akun ? <a href="<?= base_url('login'); ?>" class=" text-white">Masuk</a></p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

</section>