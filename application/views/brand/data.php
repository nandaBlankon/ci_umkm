<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Data Brand</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">
                <h3 class="box-title"><a href="<?= site_url('brand/tambah') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a></h3>
            </div>
            <div class="box-body">
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Brand</th>
                            <th>Nama Brand</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->id_brand ?></td>
                                <td><?= ucwords($data->nama_brand) ?></td>
                                <td class="btn-group">
                                    <a href="<?= site_url('brand/edit/' . $data->id_brand) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                    <a href="<?= site_url('brand/hapus/' . $data->id_brand) ?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->