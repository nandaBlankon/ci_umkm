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
                                        echo $durasi->format('%Y tahun %m bulan %d hari %H jam %i menit %s detik');
                                    } else if ($data->bukti_pembayaran != null) {
                                        echo "<span class='badge badge-success'>Pembayaran Lunas</span>";
                                        if ($data->status == 1) {
                                            echo "<span class='badge badge-info'>Barang Sudah Dikirim</span>";
                                        } elseif ($data->status == 2) {
                                            echo "<span class='badge badge-info'>Barang Sudah Diterima</span>";
                                        } else {
                                            echo "<span class='badge badge-danger'>Orderan sedang diproses penjual</span>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary btn-flat btn-sm" title="Detail Order/Transaksi" data-toggle="modal" data-target="#modalDetail<?= $data->id_order ?>"><i class="fa fa-shopping-cart"></i></a>
                                        <?php if ($data->status == 1) : ?>
                                            <a href="<?= base_url('transaksi/barangDiterima/' . $data->id_do); ?>" class="btn btn-success btn-flat btn-sm text-xs" title="Klaim barang diterima">Barang diterima</a>
                                        <?php endif ?>
                                        <?php
                                        // jika bukti pembayaran masih kosong 
                                        if ($data->bukti_pembayaran == null) {
                                        ?>
                                            <a href="" class="btn btn-success btn-flat btn-sm" title="Upload Bukti Transfer" data-toggle="modal" data-target="#modalStruk<?= $data->id_order ?>"><i class="fa fa-credit-card"></i></a>
                                        <?php } ?>
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
                                                    <p>
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th align="center">Image Produk</th>
                                                                <th>Produk</th>
                                                                <th>Warna</th>
                                                                <th>Ukuran</th>
                                                                <th>Berat</th>
                                                                <th>Kondisi</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah Order</th>
                                                                <th>Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center"><img src="<?= base_url('uploads/produk/' . $foto->image); ?>" class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 8rem;"></td>
                                                                <td><?= ucfirst($data->judul); ?></td>
                                                                <td><?= $data->warna; ?></td>
                                                                <td><?= $data->ukuran; ?></td>
                                                                <td><?= $data->berat; ?></td>
                                                                <td><?= $data->kondisi; ?></td>
                                                                <td align="right"><?= number_format($data->harga, 0, ",", "."); ?></td>
                                                                <td><?= $data->qty; ?> <?= ucfirst($data->satuan); ?></td>
                                                                <td align="right"><?= number_format($data->grand_total, 0, ",", "."); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Modal Upload Bukti Pembayaran -->
                                    <div class="modal fade" id="modalStruk<?= $data->id_order ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Form upload bukti transfer</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>
                                                        ID ORDER: <?= date('dmy') ?>:<?= $data->id_order ?>
                                                    </p>
                                                    <p>
                                                    <form action="<?= site_url('pemesanan/uploadstruk') ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_order" value="<?= $data->id_order ?>">
                                                        <div class="input-group input-group-sm">
                                                            <input type="file" name="bukti_pembayaran" class="form-control" required="">
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-upload"></i> Upload!</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                    </p>
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