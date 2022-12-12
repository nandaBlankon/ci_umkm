<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Data Pembeli</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">

            </div>
            <div class="box-body">
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID </th>
                            <th>Nama Lapak</th>
                            <th>Alamat Lapak</th>
                            <th>No Telp Lapak</th>
                            <th>Email Lapak</th>
                            <th>Akun Bank</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->id_pembeli ?></td>
                                <td><?= ucwords($data->nama) ?></td>
                                <td><?= ucwords($data->alamat == null ? "Belum diisi" : $data->alamat) ?></td>
                                <td><?= ucwords($data->no_telp == null ? "Belum diisi" : $data->no_telp) ?></td>
                                <td><?= ucwords($data->email == null ? "Belum diisi" : $data->email) ?></td>
                                <td><?= ucwords($data->nama_bank == null ? "Belum diisi" : $data->nama_bank) ?> | <?= ucwords($data->no_rek) ?></td>
                                <td align="center">
                                    <?php if ($data->image == null) { ?>
                                        <img src="<?= base_url("uploads/user.png") ?>" class="img-thumbnail" width="55px">
                                    <?php } else { ?>
                                        <img src="<?= base_url("uploads/pembeli/$data->image") ?>" class="img-thumbnail" width="50%">
                                    <?php } ?>
                                </td>
                                <td class="btn-group">
                                    <?php if ($data->akun == 1) { ?>
                                        <a href="#" data-toggle="modal" data-target="#nonaktifModal" class="btn btn-primary btn-sm">Nonaktifkan</a>
                                    <?php } else if ($data->akun == 0) { ?>
                                        <a href="<?= base_url('pembeli/aktifkan/' . $data->id_pembeli) ?>" class="btn btn-primary btn-sm">Aktifkan</a>
                                    <?php } ?>
                                    <a href="<?= site_url('pembeli/hapus/' . $data->id_pembeli) ?>" title="Hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                </td>
                                <!-- Nonaftik Modal-->
                                <div class="modal fade" id="nonaktifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-bold" id="exampleModalLabel">Pemberitahuan Nonaktif Pembeli</h5>
                                            </div>
                                            <div class="modal-body">
                                                Jika anda menonaktifkan akun dari <b><?= ucfirst($data->nama) ?></b>, maka yang bersangkutan tidak dapat melakukan login ke halaman dashboard serta seluruh
                                                transaksi yang sedang berlangsung akan dibekukan secara otomatis.
                                                <p>Anda yakin ingin menonaktifkan <b><?= ucfirst($data->nama) ?>..?</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-dismiss="modal">Jangan</button>
                                                <a class="btn btn-primary" href="<?= base_url('pembeli/nonaktif/' . $data->id_pembeli) ?>">Ya, Nonaktifkan!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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