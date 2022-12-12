<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Tambah Merk Smartphone</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>
		<div class="box">
			<div class="box-header text-center">
				<h3 class="box-title"><a href="<?= site_url('merk') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a></h3>
			</div>
			<div class="box-body">
				<form action="<?= site_url('merk/proses') ?>" method="post" class="col-md-4">
					<div class="form-group <?= form_error('id_merk') ? 'has-error' : null ?>">
						<label for="id_merk">ID Merk*</label>
						<input type="text" name="id_merk" readonly class="form-control form-control-sm" value="<?= $page == 'tambah' ? $idmerk : $row->id_merk ?>">
						<?= form_error('id_merk') ?>
					</div>
					<div class="form-group <?= form_error('nama_merk') ? 'has-error' : null ?>">
						<label for="nama_merk">Nama Merk*</label>
						<input type="text" name="nama_merk" id="nama_merk" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('nama_merk') : $row->nama_merk ?>" autofocus style="text-transform: uppercase;">
						<?= form_error('nama_merk') ?>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
						<button type="reset" class="btn btn-outline-primary">Reset</button>
						<button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->