<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Transaksi Anda</small>
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
						<th>NO</th>
						<th>ID ORDER</th>
						<th>TANGGAL ORDER/TRANSAKSI</th>
						<th>TOTAL BAYAR</th>
						<th>KETERANGAN</th>
						<th>OPSI</th>
					</thead>
					<tbody>
						<?php
						$no = 1;
						#if ($row->num_rows()) {
						foreach ($row->result() as $data) :
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->id_order; ?></td>
								<td><?= $data->tanggal; ?></td>
								<td class="pull-right">Rp. <?= number_format($data->grand_total, 0, ",", "."); ?></td>
								<td>
									<?php
									// jika bukti pembayaran masih kosong 
									if ($data->bukti_pembayaran == null) {
										echo "<span class='badge badge-light'><small>Menunggu Pembayaran</small></span>";
									} else if ($data->bukti_pembayaran != null) {
										if ($detailOrder[0]['status'] == 1) {
											echo "<span class='badge badge-light'><small>Barang Sedang Dikirim</small></span>";
										} else {
											echo "<span class='badge badge-light'><small>Orderan sedang diproses penjual</small></span>";
										}
									}
									?>
								</td>
								<td>
									<div class="btn-group">
										<a href="" class="btn btn-primary btn-flat btn-sm" title="Detail Order/Transaksi" data-toggle="modal" data-target="#modalDetail<?= $data->id_order ?>"><i class="fa fa-shopping-cart"></i></a>
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
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Detail Order/Transaksi</h4>
												</div>
												<div class="modal-body">
													<p>
														<table class="table">
															<thead>
																<tr>
																	<th align="center">###</th>
																	<th>Produk</th>
																	<th>Harga</th>
																	<th>QTY</th>
																	<th>Sub Total</th>
																	<th>Penjual</th>
																</tr>
															</thead>
															<tbody>
																<?php
																foreach ($detailOrder as $do) :
																	$foto = $this->db->query("SELECT * FROM tb_image WHERE id_penjualan='$do[id_penjualan]' LIMIT 1")->result_array();
																?>
																	<tr>
																		<td><img src="<?= base_url('uploads/image/' . $foto[0]['image']) ?>" width="80px"></td>
																		<td><?= $do['judul']; ?></td>
																		<td><?= number_format($do['harga'], 0, ",", "."); ?></td>
																		<td><?= $do['qty']; ?> Unit</td>
																		<td><?= number_format($do['total_harga'], 0, ",", "."); ?></td>
																		<td><a href="<?= site_url('penjual/' . $do['id_penjual']) ?>" title="Kunjungi Lapak"><?= $do['nama']; ?></a></td>

																	</tr>
																<?php endforeach ?>
																<tr>
																	<td colspan="4" align="right">GRAND TOTAL</td>
																	<td><?= number_format($data->grand_total, 0, ",", "."); ?></td>
																	<td></td>
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->