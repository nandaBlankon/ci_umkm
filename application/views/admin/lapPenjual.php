<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                LAPORAN USAHA PENJUAL BERDASARKAN JENIS USAHA <?= $cat == 'umkm' ? 'UMKM' : 'HOME INDUSTRI'; ?>
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <center>
                <!-- <a href="./kategori/tambah" class="btn btn-primary btn-icon-split btn-sm mb-3">
                    <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                    <span class="text">Cetak Laporan</span>
                </a> -->
            </center>

            <div class="table-responsive">
                <table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">

                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Alamat Usaha</th>
                            <th>Bergabung</th>
                            <th>No Telp Usaha</th>
                            <th>Pemilik</th>
                            <th>Email Pemilik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) :
                            $query = $this->db->query("select * from tb_user where user_id='$data->user_id'")->row();
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= ucfirst($data->nama_usaha); ?></td>
                                <td>
                                    <?= ucfirst($data->alamat_usaha); ?>
                                    Desa <?= ucfirst($data->desa); ?>
                                    Kec. <?= ucfirst($data->kecamatan); ?>
                                    Kab. <?= ucfirst($data->kabupaten); ?>
                                </td>
                                <td><?= ucfirst($data->bergabung); ?></td>
                                <td><?= ucfirst($data->no_hp); ?></td>
                                <td><?= ucfirst($query->nama); ?></td>
                                <td><?= ucfirst($query->username); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>