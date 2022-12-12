<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				Data Kategori Produk
			</h6>
		</div>
		<div class="card-body">
			<?php $this->view('messages') ?>
			<center>
				<a href="./kategori/tambah" class="btn btn-primary btn-icon-split btn-sm mb-3">
					<span class="icon text-white-50"><i class="fas fa-plus"></i></span>
					<span class="text">Tambah Kategori Baru</span>
				</a>
			</center>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Kategori</th>
							<th>Nama Kategori</th>
							<th>Image</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($row->result() as $data) :
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->id_kategori; ?></td>
								<td><?= ucwords($data->nama_kategori); ?></td>
								<td>
									<img src="<?= base_url('uploads/kategori/' . $data->image); ?>" class="img-fluid img-circle" width="20%">
								</td>
								<td>
									<a href="<?= base_url('kategori/edit/' . $data->id_kategori); ?>" class="btn btn-circle btn-warning"><i class="fas fa-edit"></i></a>
									<a href="<?= base_url('kategori/hapus/' . $data->id_kategori); ?>" class="btn btn-circle btn-danger"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>