<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                LAPORAN KESELERUHAN TRANSAKSI PENJUAL
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <center>
                <form method="get" action="<?php echo base_url('transaksi/laporanTransaksiPenjual') ?>" class="form">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Transaksi dari tanggal</label>
                                <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sampai dengan tanggal</label>
                                <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off" required>
                            </div>
                        </div>

                    </div>
                    <button type="submit" name="filter" value="true" class="btn btn-primary btn-sm">TAMPILKAN</button>
                    <?php
                    if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                        echo '<a href="' . base_url('transaksi/laporanTransaksiPenjual') . '" class="btn btn-danger btn-sm">RESET</a>';
                    ?>
                </form>
            </center>
            <div class="table-responsive">
                <table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Order</th>
                            <th>Tanggal Order</th>
                            <th>Total Tagihan</th>
                            <th>Detail Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($order)) {  // Jika data tidak ada
                            $no = 1;
                            if (empty($_GET['filter'])) {
                                foreach ($row->result() as $data) :
                                    $detailOrder = $this->db->query("select * from tb_detail_order,tb_produk where tb_detail_order.id_produk=tb_produk.id_produk and tb_detail_order.id_order='$data->id_order'")->row();
                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data->id_order; ?></td>
                                        <td><?= $data->tanggal; ?></td>
                                        <td><?= $this->fungsi->nominal($data->grand_total) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-circle" title="Detail Order/Transaksi" data-toggle="modal" data-target="#modalDetail<?= $data->id_order ?>">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
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
                                                                        <td><?= ucfirst($detailOrder->judul); ?></td>
                                                                        <td><?= $detailOrder->warna; ?></td>
                                                                        <td><?= $detailOrder->ukuran; ?></td>
                                                                        <td><?= $detailOrder->berat; ?></td>
                                                                        <td><?= $detailOrder->kondisi; ?></td>
                                                                        <td align="right"><?= number_format($detailOrder->harga, 0, ",", "."); ?></td>
                                                                        <td><?= $detailOrder->qty; ?> <?= ucfirst($detailOrder->satuan); ?></td>
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
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php } ?>
                            <?php } else { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                            $no = 1;
                            foreach ($order as $data) :
                                $detailOrder = $this->db->query("select * from tb_detail_order,tb_produk where tb_detail_order.id_produk=tb_produk.id_produk and tb_detail_order.id_order='$data->id_order'")->row();
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data->id_order; ?></td>
                                    <td><?= $data->tanggal ?></td>
                                    <td><?= $this->fungsi->nominal($data->grand_total) ?></td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-circle" title="Detail Order/Transaksi" data-toggle="modal" data-target="#modalDetail<?= $data->id_order ?>">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
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
                                                                    <td><?= ucfirst($detailOrder->judul); ?></td>
                                                                    <td><?= $detailOrder->warna; ?></td>
                                                                    <td><?= $detailOrder->ukuran; ?></td>
                                                                    <td><?= $detailOrder->berat; ?></td>
                                                                    <td><?= $detailOrder->kondisi; ?></td>
                                                                    <td align="right"><?= number_format($detailOrder->harga, 0, ",", "."); ?></td>
                                                                    <td><?= $detailOrder->qty; ?> <?= ucfirst($detailOrder->satuan); ?></td>
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
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>