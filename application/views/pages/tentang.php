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

            <!-- Order Details -->
            <div class="col-md-12  drop-shadow">

                <div class="order-summary ">
                    <h4>
                        Bagaimana Bukataplak dimulai
                    </h4>
                    <p class="">
                        <small>
                            Pendiri kami, Muhammad Januar, menghadapi pengalaman hidup dan tantangan yang luarbiasa. Founder berpikir, untuk menghentikan permasalahan ini, mereka harus melakukan sesuatu untuk memperpendek jurang pemisah antara kota besar dan kota kecil.
                        </small>
                        <br>
                        <blockquote>
                            Pada 26 September 2020, Founder meluncurkan Bukataplak dengan misi pemerataan ekonomi secara digital.
                        </blockquote>
                    </p>
                    <h4 class="text-center">
                        Untuk kedepannya, kami akan fokus pada upaya mengembangkan Super Ecosystem yang memungkinkan setiap orang dapat berkontribusi dan memberikan nilai tambah bagi satu sama lain serta tumbuh bersama.
                    </h4>
                </div>

            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->