<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Data penjual</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>
		<div class="box">
			<div class="box-header text-center">
				Data penjual/toko yang terdaftar di marketplace ini
			</div>
			<div class="box-body">
				<table id="table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Toko</th>
							<th>Nama toko</th>
							<th>Alamat toko</th>
							<th>No Telp toko</th>
							<th>Email toko</th>
							<th>Foto toko</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($row->result() as $data) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data->id_toko ?></td>
								<td><?= ucwords($data->nama_toko) ?></td>
								<td><?= ucwords($data->alamat_toko) ?></td>
								<td><?= $data->no_telp ?></td>
								<td><?= $data->email_toko ?></td>
								<td>
									<img src="<?= base_url('uploads/toko/' . $data->image) ?>" class="img-responsive thumbnail" width="80px">
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