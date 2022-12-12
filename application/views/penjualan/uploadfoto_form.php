<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Unggah Foto Penjualan</small>
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
				<form action="<?= site_url('penjualan/prosesfoto') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_penjualan" value="<?= $page == 'tambah' ? $penjualan->id_penjualan : $row->id_penjualan ?>">
					<input type="hidden" name="id_image" value="<?= $row->id_image ?>">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group <?= form_error('image') ? 'has-error' : null ?>">
								<label for="image">Unggah foto*</label>
								<small style="color: gray; margin-bottom: 0;">(Format yang didukung: <b style="color: #2196f3; text-decoration: none;">jpg | jpeg | png</b>)</small>
								<input type="file" class="form-control" name="image" id="image" required>
								<p class="help-block text-sm" style="color: red; margin-bottom: 0;"><?= $page == 'edit' ? 'kosongkan jika tidak ingin diganti' : '' ?></p>

								<span class="help-block"><?= form_error('image') ?></span>
								<?php if ($row->image == NULL) {
									echo "";
								} else {
								?>
									<img class="profile-user-img img-responsive" style="width: 50%" src="<?= base_url('uploads/image/' . $row->image) ?>">
								<?php } ?>

							</div>
						</div>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
						<button type="reset" class="btn btn-outline-primary">Reset</button>
						<button type="submit" name="<?= $page ?>" class="btn btn-primary">Unggah</button>
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