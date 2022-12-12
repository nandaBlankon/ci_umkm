<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Tambah Penjualan</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>

		<div class="box">
			<div class="box-header with-border text-center">
				<h3 class="box-title">
					<a href="<?= site_url('penjualan') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a>
				</h3>
			</div>
			<div class="box-body">
				<form action="<?= site_url('penjualan/proses') ?>" method="post">
					<input type="hidden" name="id_penjualan" value="<?= $row->id_penjualan ?>">
					<input type="hidden" name="id_penjual" value="<?= $page == 'tambah' ? $profil->id_penjual : $row->id_penjual ?>">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group <?= form_error('id_merk') ? 'has-error' : null ?>">
								<label for="id_merk">Merk Produk*</label>
								<?php echo form_dropdown('id_merk', $merk, $selectedmerk, ['class' => 'form-control form-control-sm', 'id' => 'id_merk']); ?>
							</div>
						</div>
						<div class="col-xs-12">

						</div>
					</div>
					<div class="form-group <?= form_error('judul') ? 'has-error' : null ?>">
						<label for="judul">Judul penjualan*</label>
						<input type="text" name="judul" id="judul" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('judul') : $row->judul ?>" style="text-transform: uppercase;" autofocus>
						<?= form_error('judul') ?>
					</div>
					<div class="form-group <?= form_error('deskripsi') ? 'has-error' : null ?>">
						<label for="deskripsi">Deskripsi Penjualan*</label>
						<textarea class="textarea" name="deskripsi" id="editor1" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          		<?= $page == 'tambah' ? set_value('deskripsi') : $row->deskripsi ?>
                          </textarea>
						<?= form_error('deskripsi') ?>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-3">
							<div class="form-group <?= form_error('harga') ? 'has-error' : null ?>">
								<label for="harga">Harga*</label>
								<small>(misal: 12000)</small>
								<div class="input-group">
									<span class="input-group-addon">Rp.</span>
									<input type="number" name="harga" id="harga" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('harga') : $row->harga ?>">
									<span class="input-group-addon">Gr</span>
								</div>
								<?= form_error('harga') ?>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group <?= form_error('kondisi') ? 'has-error' : null ?>">
								<label for="satuan">Kondisi*</label>
								<select name="kondisi" class="form-control form-control-sm">
									<option value="Baru" <?= $row->kondisi == 'Baru' ? "selected" : null; ?>>Baru</option>
									<option value="Bekas" <?= $row->kondisi == 'Bekas' ? "selected" : null; ?>>Bekas</option>
								</select>
								<?= form_error('kondisi') ?>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group <?= form_error('stok') ? 'has-error' : null ?>">
								<label for="stok">Stok*</label>
								<input type="number" name="stok" id="stok" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('stok') : $row->stok ?>">
								<?= form_error('stok') ?>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group <?= form_error('berat') ? 'has-error' : null ?>">
								<label for="berat">Berat*</label>
								<small>(misal: 1000 gr)</small>
								<div class="input-group">
									<input type="number" name="berat" id="berat" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('berat') : $row->berat ?>">
									<span class="input-group-addon">Gr</span>
								</div>
								<?= form_error('berat') ?>
							</div>
						</div>

					</div>
					<div class="form-group <?= form_error('warna') ? 'has-error' : null ?>">
						<label for="warna">Warna*</label>
						<select class="form-control select2" name="warna[]" multiple="multiple" data-placeholder="Pilih warna">
							<?php foreach ($warna->result() as $val) : ?>
								<!-- EDITED -->
								<?php
								$selected = "";
								if ($this->router->fetch_method() == "edit") {
									$id_penjualan = $this->uri->segment(3);
									$warnaterpilih = $this->model_penjualan->warnaTerpilih($id_penjualan, $val->id_warna)->result_array();
									if (count($warnaterpilih) == 0) {
										$selected = "";
									} else {
										$selected = "selected";
									}
								}
								?>
								<option value="<?= $val->id_warna ?>" <?php echo $selected; ?>><?= $val->warna ?></option>
								<!-- END EDITED -->
							<?php endforeach ?>
						</select>
						<?= form_error('warna') ?>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
						<button type="reset" class="btn btn-outline-primary">Reset</button>
						<button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->