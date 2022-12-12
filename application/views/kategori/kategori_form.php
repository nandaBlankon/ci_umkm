<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				Tambah Kategori Baru
			</h6>
		</div>
		<div class="card-body">
			<?php $this->view('messages') ?>
			<p class="text-center">
				<a href="<?= site_url('kategori') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a>
			</p>
			<form action="<?= site_url('kategori/proses') ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="id_kategori">ID Kategori*</label>
					<input type="text" name="id_kategori" id="id_kategori" class="form-control form-control-sm" value="<?= $page == 'tambah' ? $idkategori : $row->id_kategori ?>" readonly>
				</div>
				<div class="form-group <?= form_error('nama_kategori') ? 'has-error' : null ?>">
					<label for="nama_kategori">Nama Kategori*</label>
					<input type="text" name="nama_kategori" id="forslug" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('nama_kategori') : $row->nama_kategori ?>" autofocus style="text-transform: uppercase;">
					<?= form_error('nama_kategori') ?>
				</div>
				<div class="form-group">
					<label for="slug">Slug URL</label>
					<input type="text" name="slug" id="slug" readonly class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('slug') : $row->slug ?>">
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="image">Image</label>
							<input type="file" name="image" readonly class="form-control form-control-sm" value="">
							<small>Kosongkan jika tidak ingin di <?= $page; ?></small>
						</div>
						<?php if ($page == 'edit') : ?>
							<div class="col-md-6">
								<div class="img-responsive img-fluid">
									<img src="<?= base_url('uploads/kategori/' . $row->image); ?>" width="25%" class="img-thumbnail">
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>

				<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
					<button type="reset" class="btn btn-outline-primary">Reset</button>
					<button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

</div>