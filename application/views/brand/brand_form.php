<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Tambah Brand</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">
                <h3 class="box-title"><a href="<?= site_url('brand') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a></h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('brand/proses') ?>" method="post">
                    <div class="form-group">
                        <label for="id_brand">ID Brand*</label>
                        <input type="text" name="id_brand" id="id_brand" class="form-control form-control-sm" value="<?= $page == 'tambah' ? $idbrand : $row->id_brand ?>" readonly>
                    </div>
                    <div class="form-group <?= form_error('nama_brand') ? 'has-error' : null ?>">
                        <label for="nama_brand">Nama Brand*</label>
                        <input type="text" name="nama_brand" id="nama_brand" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('nama_brand') : $row->nama_brand ?>" autofocus style="text-transform: uppercase;">
                        <?= form_error('nama_brand') ?>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                        <button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->