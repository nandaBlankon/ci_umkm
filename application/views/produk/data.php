<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Produk
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <?php if ($this->fungsi->user_login()->level != 1) : ?>
                <center>
                    <a href="./produk/tambah" class="btn btn-primary btn-icon-split btn-sm mb-3">
                        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                        <span class="text">Tambah Produk Baru</span>
                    </a>
                </center>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Foto Produk</th>
                            <th>No</th>
                            <th>Kategori Produk</th>
                            <th>Judul/Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) :
                        ?>
                            <tr>
                                <td>
                                    <!-- menampilkan foto produk berdasarkan id_produk -->
                                    <?php
                                    $query = $this->db->query("select * from tb_image_produk where id_produk='$data->id_produk' order by id_image ASC");
                                    ?>
                                    <!-- end menampilkan foto produk berdasarkan id_produk -->
                                    <?php if ($query->num_rows()) { ?>
                                        <!-- coding menampilkan foto produk disini -->
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php foreach ($query->result() as $key => $image) : ?>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? "active" : null; ?>"></li>
                                                <?php endforeach ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php foreach ($query->result() as $key => $image) : ?>
                                                    <div class="carousel-item <?= $key == 0 ? "active" : null; ?>">
                                                        <img class="d-block w-100 img-thumbnail" src="<?= base_url('uploads/produk/' . $image->image) ?>" style="height: 170px;">
                                                        <?php if ($this->fungsi->user_login()->level != 1) : ?>
                                                            <div class="carousel-caption">
                                                                <a href="<?= site_url('produk/editfoto/' . $image->id_image) ?>" class="btn btn-circle btn-warning btn-sm" title="Ganti Foto ini"><i class="fa fa-plus"></i></a>
                                                                <a href="<?= site_url('produk/hapusfoto/' . $image->id_image) ?>" class="btn btn-circle btn-danger btn-sm" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <?php if ($this->fungsi->user_login()->level != 1) : ?>
                                            <!-- jika user login nya admin jangan tampilkan -->
                                            <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                                Unggah Lagi Foto</a>
                                        <?php endif ?>
                                    <?php } else { ?>
                                        <?php if ($this->fungsi->user_login()->level != 1) : ?>
                                            <!-- jika user login nya admin jangan tampilkan -->
                                            <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                                Unggah Foto Produk</a>
                                        <?php endif ?>
                                    <?php } ?>
                                </td>
                                <td><?= $no++; ?></td>
                                <td><?= ucwords($data->nama_kategori); ?></td>
                                <td><?= ucwords($data->judul); ?></td>
                                <td><?= $this->fungsi->nominal($data->harga) ?></td>
                                <td><?= $data->stok; ?></td>
                                <td>
                                    <?php if ($this->fungsi->user_login()->level != 1) : ?>
                                        <!-- jika user login nya admin jangan tampilkan -->
                                        <a href="<?= base_url('produk/edit/' . $data->id_produk); ?>" class="btn btn-circle btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('produk/hapus/' . $data->id_produk); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-circle btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    <?php endif ?>
                                    <a href="" data-toggle="modal" data-target="#deskripsiModal<?= $data->id_produk ?>" class="btn btn-circle btn-success btn-sm" title="Detail Produk"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>

                            <!-- Start Deskripsi Modal-->
                            <div class="modal fade" id="deskripsiModal<?= $data->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-bold" id="exampleModalLabel">Detail Produk</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Informasi Produk</li>
                                                        <li class="list-group-item">
                                                            <small>Kategori produk</small><br>
                                                            <?= ucwords($data->nama_kategori); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Judul/Nama produk</small><br>
                                                            <?= ucwords($data->judul); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Harga produk</small><br>
                                                            <?= $this->fungsi->nominal($data->harga); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Stok produk</small><br>
                                                            <?= $data->stok; ?> <?= ucwords($data->satuan); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Kondisi produk</small><br>
                                                            <?= $data->kondisi == null ? '-' : ucwords($data->kondisi); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Berat produk</small><br>
                                                            <?= $data->berat == null ? 0 : $data->berat; ?> Gram
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Foto Produk</li>
                                                        <li class="list-group-item">
                                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                                <ol class="carousel-indicators">
                                                                    <?php foreach ($query->result() as $key => $image) : ?>
                                                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? "active" : null; ?>"></li>
                                                                    <?php endforeach ?>
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    <?php foreach ($query->result() as $key => $image) : ?>
                                                                        <div class="carousel-item <?= $key == 0 ? "active" : null; ?>">
                                                                            <img class="d-block w-100 img-thumbnail" src="<?= base_url('uploads/produk/' . $image->image) ?>" style="height: 412px;">
                                                                            <?php if ($this->fungsi->user_login()->level != 1) : ?>
                                                                                <div class="carousel-caption">
                                                                                    <a href="<?= site_url('produk/editfoto/' . $image->id_image) ?>" class="btn btn-circle btn-warning btn-sm" title="Ganti Foto ini"><i class="fa fa-plus"></i></a>
                                                                                    <a href="<?= site_url('produk/hapusfoto/' . $image->id_image) ?>" class="btn btn-circle btn-danger btn-sm" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
                                                                                </div>
                                                                            <?php endif ?>
                                                                        </div>
                                                                    <?php endforeach ?>
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Warna Produk</li>
                                                        <li class="list-group-item">
                                                            <!-- menampilkan warna produk berdasarkan id_produk -->
                                                            <?php
                                                            $query = $this->db->query("select * from tb_warna_produk,tb_warna where tb_warna_produk.id_warna=tb_warna.id_warna and id_produk='$data->id_produk' order by id ASC");
                                                            ?>
                                                            <!-- end menampilkan warna produk berdasarkan id_produk -->

                                                            <?php foreach ($query->result() as $warna) : ?>
                                                                <span class="badge badge-<?= $warna->warna == 'Hitam' ? 'dark' : ($warna->warna == 'Putih' ? 'light' : ($warna->warna == 'Merah' ? 'danger' : 'secondary')); ?>">
                                                                    <?= $warna->warna; ?>
                                                                </span>
                                                            <?php endforeach ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Ukuran Produk</li>
                                                        <li class="list-group-item">
                                                            <!-- menampilkan warna produk berdasarkan id_produk -->
                                                            <?php
                                                            $query = $this->db->query("select * from tb_ukuran_produk,tb_ukuran where tb_ukuran_produk.id_ukuran=tb_ukuran.id_ukuran and id_produk='$data->id_produk' order by id ASC");
                                                            ?>
                                                            <!-- end menampilkan warna produk berdasarkan id_produk -->
                                                            <?php foreach ($query->result() as $ukuran) : ?>
                                                                <span class="badge badge-primary">
                                                                    Ukuran <?= $ukuran->ukuran; ?>
                                                                </span>
                                                            <?php endforeach ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Deskripsi Produk</h6>
                                                </div>
                                                <div class="card-body">
                                                    <?= ucfirst($data->deskripsi); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Deskripsi Modal-->

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>