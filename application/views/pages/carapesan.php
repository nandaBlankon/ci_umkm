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

            <div class="col-md-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Cara Pembayaran
                        <hr>
                    </h3>
                </div>
                <div class="order-summary">

                </div>
            </div>
            <!-- /Order Details -->


        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->