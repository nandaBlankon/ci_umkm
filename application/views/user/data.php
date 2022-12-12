<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Pengguna
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
                            <th>No</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Jekel</th>
                            <th>Level</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data->user_id; ?></td>
                                <td><?= $data->username; ?></td>
                                <td><?= $data->nama; ?></td>
                                <td><?= $data->jekel; ?></td>
                                <td><?= $data->level == 1 ? 'Admin' : "Kostumer"; ?></td>
                                <!-- <td></td> -->
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>