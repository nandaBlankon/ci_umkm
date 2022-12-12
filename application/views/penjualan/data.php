<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Data Penjualan Anda</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>
		<div class="box">
			<div class="box-header text-center">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<table id="table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">
								<a href="<?= site_url('penjualan/tambah') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($row->result() as $data) : ?>
							<tr>
								<td>
									<div class="row">
										<div class="col-md-4">
											<div class="box box-solid">
												<div class="box-header with-border">
													<h3 class="box-title">Foto Produk</h3>
												</div>
												<div class="box-body">
													<div class="row">
														<!-- menampilkan foto produk berdasarkan id_penjualan -->
														<?php
														$query = $this->db->query("select * from tb_image where id_penjualan='$data->id_penjualan' order by id_image ASC");
														?>
														<!-- end menampilkan foto produk berdasarkan id_penjualan -->
														<?php
														if ($query->num_rows()) {
														?>
															<div class="col-md-12">
																<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
																	<ol class="carousel-indicators">
																		<?php foreach ($query->result() as $key => $image) : ?>
																			<li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? "active" : null; ?>"></li>
																		<?php endforeach ?>
																	</ol>
																	<div class="carousel-inner">
																		<?php foreach ($query->result() as $key => $image) : ?>
																			<div class="item <?= $key == 0 ? "active" : null; ?>">
																				<img src="<?= base_url('uploads/image/' . $image->image) ?>" style="height: 170px;" class="center-block">

																				<div class="carousel-caption">
																					<a href="<?= site_url('penjualan/editfoto/' . $image->id_image) ?>" class="btn btn-primary btn-xs btn-flat" title="Ganti Foto ini"><i class="fa fa-plus"></i></a>
																					<a href="<?= site_url('penjualan/hapusfoto/' . $image->id_image) ?>" class="btn btn-danger btn-xs btn-flat" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
																				</div>
																			</div>
																		<?php endforeach ?>
																	</div>
																	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
																		<span class="fa fa-angle-left"></span>
																	</a>
																	<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
																		<span class="fa fa-angle-right"></span>
																	</a>
																</div>
															</div>

															<div class="col-md-12">
																<p class="text-center">
																	<a href="<?= site_url('penjualan/uploadfoto/' . $data->id_penjualan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Unggah Foto Lagi</a>
																</p>
															</div>
														<?php } else { ?>
															<p class="text-center" style="color: red; text-decoration: none;"><b>Anda belum mengunggah foto produk.</b></p>
															<p class="text-center">
																<a href="<?= site_url('penjualan/uploadfoto/' . $data->id_penjualan) ?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Unggah Foto</a>
															</p>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="box box-solid">
												<div class="box-header with-border">
													<h3 class="box-title"><?= $data->judul ?></h3>
												</div>
												<!-- /.box-header -->
												<div class="box-body">
													<dl class="dl">
														<dt class="text-center">INFO PRODUK</dt>
														<dd>
															<table class="small table">
																<tr>
																	<th>MERK PRODUK</th>
																	<th>HARGA</th>
																	<th>KONDISI</th>
																	<th>BERAT</th>
																	<th>STOK</th>
																	<th>WARNA</th>
																</tr>
																<tr>
																	<td><?= $data->nama_merk ?></td>
																	<td><?= $this->fungsi->nominal($data->harga) ?></td>
																	<td><?= $data->kondisi ?></td>
																	<td><?= $data->berat ?> Gr</td>
																	<td><?= $data->stok ?></td>
																	<td align="left">
																		<!-- menampilkan warna produk berdasarkan id_penjualan -->
																		<?php
																		$query = $this->db->query("select * from tb_penjualan_warna,tb_warna where tb_penjualan_warna.id_warna=tb_warna.id_warna and id_penjualan='$data->id_penjualan' order by id ASC");
																		?>
																		<!-- end menampilkan warna produk berdasarkan id_penjualan -->

																		<?php foreach ($query->result() as $warna) : ?>
																			<span class="label label-default"><?= $warna->warna; ?></span>
																		<?php endforeach ?>
																	</td>
																</tr>
															</table>
														</dd>
														<dt class="text-center">
															<a href="" data-toggle="modal" data-target="#deskripsiModal<?= $data->id_penjualan ?>" class="btn btn-sm btn-flat btn-info"> LIHAT DESKRIPSI PRODUK</a>
														</dt>
														<!-- Start Deskripsi Modal-->
														<div class="modal fade" id="deskripsiModal<?= $data->id_penjualan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title text-bold" id="exampleModalLabel">Deskripsi Produk</h5>
																	</div>
																	<div class="modal-body">
																		<?= $data->deskripsi; ?>
																	</div>
																	<div class="modal-footer">
																		<button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
																	</div>
																</div>
															</div>
														</div>
														<!-- End Deskripsi Modal-->
													</dl>
												</div>
												<div class="box-footer text-center">
													<a href="<?= site_url('penjualan/edit/' . $data->id_penjualan) ?>" class="btn btn-flat btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
													<a href="<?= site_url('penjualan/hapus/' . $data->id_penjualan) ?>" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
												</div>
												<!-- /.box-body -->
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