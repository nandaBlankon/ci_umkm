<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Form Unggah Foto Produk
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <center>
                <a href="<?= base_url('usaha/usahaSaya'); ?>" class="btn btn-primary btn-icon-split btn-sm mb-3">
                    <span class="icon text-white-50"><i class="fas fa-backward"></i></span>
                    <span class="text">Batal Unggah Foto</span>
                </a>
            </center>

            <form action="<?= site_url('produk/prosesfoto') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?= $page == 'tambah' ? $produk->id_produk : $row->id_produk ?>">
                <input type="hidden" name="id_image" value="<?= $row->id_image ?>">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group <?= form_error('image') ? 'has-error' : null ?>">
                            <label for="image">Unggah foto*</label>
                            <small style="color: gray; margin-bottom: 0;">(Format yang didukung: <b style="color: #2196f3; text-decoration: none;">jpg | jpeg | png</b>)</small>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <p class="help-block text-sm" style="color: red; margin-bottom: 0;"><?= $page == 'edit' ? 'kosongkan jika tidak ingin diganti' : '' ?></p>

                            <span class="help-block"><?= form_error('image') ?></span>
                            <?php if ($row->image == NULL) {
                                echo "";
                            } else {
                            ?>
                                <img class="profile-user-img img-responsive img-thumbnail" style="width: 50%" src="<?= base_url('uploads/produk/' . $row->image) ?>">
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                    <button type="submit" name="<?= $page ?>" class="btn btn-primary">Unggah</button>
                </div>
            </form>
        </div>
    </div>

</div>