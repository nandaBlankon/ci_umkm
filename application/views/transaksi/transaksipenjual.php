<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Transaksi dari pembeli</small>
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
						<th>PRODUK</th>
						<th>QTY</th>
						<th>TOTAL HARGA</th>
						<th>TANGGAL ORDER</th>
						<th>KETERANGAN</th>
						<th>OPSI</th>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($row->result() as $data) :
							$query = $this->db->query("select * from tb_pembeli where id_pembeli='$data->id_pembeli' order by id_pembeli ASC LIMIT 1");
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->judul; ?></td>
								<td><?= $data->qty; ?>x</td>
								<td><?= number_format($data->total_harga, 0, ",", "."); ?></td>
								<td><?= $data->tanggal; ?></td>
								<td>
									<?php
									// jika bukti pembayaran masih kosong 
									if ($data->bukti_pembayaran == null) {
										echo "<span class='badge badge-light'><small>Menunggu Pembayaran</small></span>";
									} else if ($data->bukti_pembayaran != null) {
										echo "<span class='badge badge-light'><small>Pembayaran Oke</small></span>";
									}
									?>
									<?php foreach ($query->result() as $pembeli) : ?>
										<a href="" class="btn btn-success btn-flat btn-xs" title="Informasi Pembeli" data-toggle="modal" data-target="#modalInformasi<?= $pembeli->id_pembeli; ?>"><i class="fa fa-user-o"></i></a>

										<!-- Modal -->
										<div class="modal fade" id="modalInformasi<?= $pembeli->id_pembeli ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg">

												<!-- Modal Informasi Pembeli-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Informasi Pembeli</h4>
													</div>
													<div class="modal-body">
														<p>
														<table class="table" width="100%">
															<thead>
																<tr>
																	<th>Foto</th>
																	<th>Biodata</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td align="center">
																		<img src="<?= base_url('uploads/pembeli/' . $pembeli->image) ?>" style="width: 40%;">
																	</td>
																	<td>
																		<table width="100%">
																			<tr>
																				<th>User ID</th>
																				<td>:</td>
																				<td><?= $pembeli->user_id; ?></td>
																			</tr>
																			<tr>
																				<th>Nama Lengkap</th>
																				<td>:</td>
																				<td><?= $pembeli->nama; ?></td>
																			</tr>
																			<tr>
																				<th>Alamat</th>
																				<td>:</td>
																				<td><?= $pembeli->alamat; ?></td>
																			</tr>
																			<tr>
																				<th>Nomor Telp</th>
																				<td>:</td>
																				<td><?= $pembeli->no_telp; ?></td>
																			</tr>
																			<tr>
																				<th>Email</th>
																				<td>:</td>
																				<td><?= $pembeli->email; ?></td>
																			</tr>
																		</table>
																	</td>
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
									<?php endforeach ?>
								</td>
								<td>
									<div class="btn-group">
										<?php if ($data->status == 0) { ?>
											<a href="<?= site_url('transaksi/kirimbarang/' . $data->id_do) ?>" class="btn btn-danger btn-flat btn-xs" title="Kirim Barang"><i class="fa fa-truck"></i> Kirim Barang</a>
										<?php } else if ($data->status == 1) { ?>
											<span class="btn btn-success btn-flat btn-xs" title="Barang Sudah Dikirim"><i class="fa fa-plane"></i> Barang Dikirim</span>
										<?php } ?>
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