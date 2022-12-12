<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Tambah Data Penjual</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">
                <h3 class="box-title"><a href="<?= site_url('penjual') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a></h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('penjual/proses') ?>" method="post" class="col-md-4">
                    <div class="form-group <?= form_error('id_penjual') ? 'has-error' : null ?>">
                        <label for="id_penjual">ID penjual*</label>
                        <input type="text" name="id_penjual" readonly class="form-control form-control-sm" value="<?= $page == 'tambah' ? $idpenjual : $row->id_penjual ?>">
                        <?= form_error('id_penjual') ?>
                    </div>
                    <div class="form-group <?= form_error('nama_penjual') ? 'has-error' : null ?>">
                        <label for="nama_penjual">Nama penjual*</label>
                        <input type="text" name="nama_penjual" id="nama_penjual" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('nama_penjual') : $row->nama_penjual ?>" autofocus style="text-transform: uppercase;">
                        <?= form_error('nama_penjual') ?>
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