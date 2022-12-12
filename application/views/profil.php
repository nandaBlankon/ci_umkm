<?php
$name = $this->fungsi->user_login()->nama;
$jekel = $this->fungsi->user_login()->jekel;
$level = $this->fungsi->user_login()->level;
$tgl = $this->fungsi->user_login()->tanggal;
?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
		<a href="<?= base_url(''); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kunjungi Marketplace</a>
	</div>
	<?php $this->view('messages') ?>
	<div class="row">

		<!-- Foto profil -->
		<div class="col-md-3">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">My Profile Picture</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body text-center">
					<?php if ($this->fungsi->user_login()->image) { ?>
						<img src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image); ?>" class="img-responsive img-thumbnail">
						<div class="mt-4 text-center small">
							<form action="<?= base_url('dashboard/profilpicupdate'); ?>" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="user_id" value="<?= $this->fungsi->user_login()->user_id ?>">
								<input type="file" name="image" class="mb-2" required>
								<button type="submit" class="btn btn-facebook btn-block btn-sm">Ganti Foto Profil</button>
							</form>
						</div>
					<?php } else { ?>
						<img src="" alt="Foto profil belum ada" class="img-responsive img-thumbnail text-danger mb-4">
						<form action="<?= base_url('dashboard/profilpicupdate'); ?>" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="user_id" value="<?= $this->fungsi->user_login()->user_id ?>">
							<input type="file" name="image" class="mb-3" required>
							<button type="submit" class="btn btn-facebook btn-block btn-sm"><i class="fa fa-user-circle"></i> Pasang Foto Profil</button>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>

		<!-- My Profile -->
		<div class="col-md-9">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">My Profile</h6> <small class="text-info">MULAI BERGABUNG: <?= $tgl ?></small>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<!-- Cek apakah tabel profil untuk user ini masih kosong atau tidak, jika kosong arahkan link proses ke function profilinsert tambah profil dibawah. -->
					<?php if (empty($porfil)) { ?>
						<form action="<?= site_url('dashboard/profilinsert') ?>" method="post">
						<?php } else { ?>
							<form action="<?= site_url('dashboard/profilupdate') ?>" method="post">
							<?php } ?>
							<input type="hidden" name="user_id" value="<?= $this->fungsi->user_login()->user_id ?>">
							<div class="row">
								<div class="col-6">
									<div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
										<label for="nama">Nama lengkap*</label>
										<input type="text" name="nama" id="nama" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->nama ?>">
										<?= form_error('nama') ?>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
										<label for="username">Email*</label>
										<input type="email" name="email" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->username ?>">
										<?= form_error('username') ?>
									</div>
								</div>
							</div>
							<div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
								<label for="alamat">Alamat*</label>
								<input type="text" name="alamat" class="form-control form-control-sm" value="<?= empty($profil) ? set_value('alamat') : $profil->alamat ?>">
								<?= form_error('alamat') ?>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group <?= form_error('no_telp') ? 'has-error' : null ?>">
										<label for="no_telp">No Telp/wa*</label>
										<input type="number" name="no_telp" class="form-control form-control-sm" value="<?= empty($profil) ? set_value('no_telp') : $profil->no_telp ?>">
										<?= form_error('no_telp') ?>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group <?= form_error('desa') ? 'has-error' : null ?>">
										<label for="desa">Desa*</label>
										<input type="text" name="desa" class="form-control form-control-sm" value="<?= empty($profil) ? set_value('desa') : $profil->desa ?>">
										<?= form_error('desa') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group <?= form_error('kecamatan') ? 'has-error' : null ?>">
										<label for="kecamatan">Kecamatan*</label>
										<input type="text" name="kecamatan" class="form-control form-control-sm" value="<?= empty($profil) ? set_value('kecamatan') : $profil->kecamatan ?>">
										<?= form_error('kecamatan') ?>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group <?= form_error('kabupaten') ? 'has-error' : null ?>">
										<label for="kabupaten">Kabupaten*</label>
										<input type="text" name="kabupaten" class="form-control form-control-sm" value="<?= empty($profil) ? set_value('kabupaten') : $profil->kabupaten ?>">
										<?= form_error('kabupaten') ?>
									</div>
								</div>
							</div>
							<div class="mt-4 text-center small">
								<button type="submit" class="btn btn-facebook btn-block btn-sm">Update Profile</button>
							</div>
							</form>

				</div>
			</div>
		</div>

	</div>

</div>