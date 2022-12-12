<style>
    .drop-shadow {
        -webkit-box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
    }

    .container.drop-shadow {
        padding-left: 0;
        padding-right: 0;
    }
</style>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header"><?= $title; ?></h3>
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

            <div class="col-md-6 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Kontak Kami
                        <hr>
                    </h3>
                </div>
                <div class="order-summary">
                    <div class="order-products">
                        <div class="order-col">
                            <div><i class="fa fa-envelope-o"></i> Email</div>
                            <div>bukataplak@gmail.com</div>
                        </div>
                        <div class="order-col">
                            <div><i class="fa fa-phone"></i> Telp</div>
                            <div>+021-95-51-84</div>
                        </div>
                        <div class="order-col">
                            <div><i class="fa fa-facebook"></i> Facebook</div>
                            <div>https://www.facebook.com/bukataplak</div>
                        </div>
                        <div class="order-col">
                            <div><i class="fa fa-instagram"></i> Instagram</div>
                            <div>@bukataplak</div>
                        </div>
                        <div class="order-col">
                            <div><i class="fa fa-twitter"></i> Twitter</div>
                            <div>@bukataplak</div>
                        </div>
                        <hr>
                        <p class="text-center">
                            <i class="fa fa-map-marker"></i> <strong> Gedung Bulan Sabit - Jalan Glee Gapui, Pulo Tanjong, Kecamtan Mila, Kabupaten Pidie, Provinsi Aceh, Indonesia.</strong>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Order Details -->

            <div class="col-md-6 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Kantor Kami
                        <hr>
                    </h3>
                </div>
                <div class="order-summary">
                    <div class="order-products">
                        <div class="order-col">

                        </div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15891.17033108082!2d95.9170218!3d5.2950321!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x673f720fcac6c370!2sFakultas%20Teknik%20UNIGHA!5e0!3m2!1sen!2sid!4v1601109733685!5m2!1sen!2sid" width="100%" height="276" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->