<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <?php $this->view('messages') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Laporan <?= $title; ?>
            </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Jml Order</th>
                            <th>Total Tagihan</th>
                            <th>Tanggal Order</th>
                            <th>Pembayaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) :
                            $foto = $this->db->query("select * from tb_image_produk where id_produk='$data->id_produk'")->row();
                            $tempo = $this->db->query("SELECT *,DATE_ADD(tanggal, INTERVAL 1 DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tanggal, INTERVAL 1 DAY), CURDATE())  FROM tb_order")->row();
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td align="center"><img src="<?= base_url('uploads/produk/' . $foto->image); ?>" class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 8rem;"></td>
                                <td><?= ucfirst($data->judul); ?></td>
                                <td><?= $data->qty; ?> <?= ucfirst($data->satuan); ?></td>
                                <td><?= $this->fungsi->nominal($data->grand_total) ?></td>
                                <td><?= $data->tanggal; ?></td>
                                <td>
                                    <?php
                                    // jika bukti pembayaran masih kosong 
                                    if ($data->bukti_pembayaran == null) {
                                        echo "<span class='badge badge-light'>Menunggu Pembayaran</span>";
                                        $waktustart = date($data->tanggal);
                                        $waktuend = date("Y-m-d h:i:sa");

                                        $datetime1 = new DateTime($waktustart); //start time
                                        $datetime2 = new DateTime($waktuend); //end time
                                        $durasi = $datetime1->diff($datetime2);
                                        echo $durasi->format('%H jam %i menit %s detik');
                                    } else if ($data->bukti_pembayaran != null) {
                                        echo "<span class='badge badge-success'>Pembayaran Lunas</span>";
                                        if ($data->status == 1) {
                                            echo "<span class='badge badge-info'>Barang Sudah Dikirim</span>";
                                        } elseif ($data->status == 2) {
                                            echo "<span class='badge badge-info'>Barang Sudah Sampai & diterima oleh pembeli</span>";
                                        } else {
                                            echo "<span class='badge badge-danger'>Produk belum dikirim </span>";
                                    ?>
                                            <a href="<?= base_url('transaksi/kirimBarang/' . $data->id_do); ?>" class='btn btn-danger btn-xs'>Kirim Produk</a>
                                    <?php    }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary btn-sm" title="Detail Order/Transaksi" data-toggle="modal" data-target="#modalDetail<?= $data->id_order ?>"><i class="fa fa-shopping-cart"></i> Details</a>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDetail<?= $data->id_order ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Order/Transaksi</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!-- Basic Card Example -->
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pembeli</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?php
                                                                    $infoPembeli = $this->db->query("select * from tb_user, tb_profil where tb_user.user_id='$data->id_pembeli'")->row();
                                                                    ?>
                                                                    <table width="100%" class=" table-responsive">
                                                                        <tr>
                                                                            <th>NAMA</th>
                                                                            <th>JEKEL</th>
                                                                            <th>ALAMAT</th>
                                                                            <th>NO TELP/WA</th>
                                                                            <th>EMAIL</th>
                                                                            <th>DESA</th>
                                                                            <th>KECAMATAN</th>
                                                                            <th>KABUPATEN</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?= $infoPembeli->nama; ?></td>
                                                                            <td><?= $infoPembeli->jekel; ?></td>
                                                                            <td><?= $infoPembeli->alamat; ?></td>
                                                                            <td><?= $infoPembeli->no_telp; ?></td>
                                                                            <td><?= $infoPembeli->email; ?></td>
                                                                            <td><?= $infoPembeli->desa; ?></td>
                                                                            <td><?= $infoPembeli->kecamatan; ?></td>
                                                                            <td><?= $infoPembeli->kabupaten; ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <!-- Basic Card Example -->
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-primary">Informasi Order</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <table width="100%" class="table-responsive">
                                                                        <tr>
                                                                            <th>Produk</th>
                                                                            <th>Qty</th>
                                                                            <th>Warna</th>
                                                                            <th>Ukuran</th>
                                                                            <th>Total Harga</th>
                                                                            <th>Tgl Order</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?= ucfirst($data->judul); ?></td>
                                                                            <td><?= ucfirst($data->qty); ?> <?= ucfirst($data->satuan); ?></td>
                                                                            <td><?= ucfirst($data->warna); ?></td>
                                                                            <td><?= ucfirst($data->ukuran); ?></td>
                                                                            <td><?= number_format($data->grand_total, 0, ",", "."); ?></td>
                                                                            <td><?= $data->tanggal; ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>