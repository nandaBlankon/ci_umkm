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
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		<?php if ($level == 1) : ?>
			<a href="<?= base_url(''); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kunjungi Marketplace</a>
		<?php endif ?>
	</div>

	<!-- menu ini hanya ditampilkan untuk admin -->
	<?php if ($level == 1) : ?>
		<!-- Content Row -->
		<div class="row">

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									Jumlah Kategori</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kategori->num_rows(); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									Jumlah Produk</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $produk->num_rows(); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-info shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah UMKM
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $umkm->num_rows(); ?></div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pending Requests Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-warning shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
									Jumlah Home Industri</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $homeIndustri->num_rows(); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	<?php endif ?>

	<!-- Content Row -->

	<!-- menu ini hanya ditampilkan untuk level 2 -->
	<?php if ($level == 2) : ?>
		<div class="card mb-4 border-left-primary border-bottom-primary">
			<div class="card-body text-justify">
				<?php if ($usahaSaya == null) : ?>
					Hai <?= $jekel == 'L' ? 'Pak' : 'Ibu' ?> <?= ucfirst($name); ?>, terima kasih sudah bergabung bersama kami. Sedikit informasi
					di Marketplace ini, anda tidak hanya sekedar dapat berbelanja saja. Akan tetapi anda juga bisa menjual produk-produk anda bersama kami dengan gratis.
					Caranya cukup mudah, klik tombol "MULAI BERJUALAN" dibawah pada kolom "Informasi Marketplace".
					Yang nantinya anda akan diarahkan ke halaman pengisian informasi mengenai Usaha yang ingin anda daftarkan disini.
					Kemudian, silakan isi seluruh pertanyaan pada form tersebut.
					<p class="mt-2">Namun, jika tujuan anda hanya ingin berbelanja produk-produk UMKM dan Home Industri yang tersedia saja, maka anda dapat mengabaikan pesan ini. Terima Kasih <i class="fas fa-laugh-wink"></i></p>
					<p class="text-dark mt-4"><u>Salam Admin</u></p>
				<?php endif ?>
				<?php if ($usahaSaya != null) : ?>
					Selamat datang kembali, <?= $jekel == 'L' ? 'Pak' : 'Ibu' ?> <?= ucfirst($name); ?>. <i class="fas fa-laugh-wink"></i>
				<?php endif ?>
			</div>
		</div>

		<?php $this->view('messages') ?>
		<div class="row">
			<!-- Selamat datang -->
			<div class="col-xl-3 col-lg-3 col-md-3">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Informasi Marketplace.</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body text-center">
						<a href="<?= base_url(''); ?>" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-cart-plus"></i>
							</span>
							<span class="text">Mulai Berbelanja</span>
						</a>
						<p class="text-dark mb-3 mt-3 blockquote">ATAU</p>
						<?php if ($usahaSaya == null) : ?>
							<a href="<?= base_url('usaha/tambah'); ?>" class="btn btn-success btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-store-alt"></i>
								</span>
								<span class="text">Mulai Berjualan</span>
							</a>
						<?php endif ?>
						<?php if ($usahaSaya != null) : ?>
							<a href="<?= base_url('produk/tambahproduk'); ?>" class="btn btn-success btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-store-alt"></i>
								</span>
								<span class="text">Tambah Produk Penjualan</span>
							</a>
						<?php endif ?>
					</div>
				</div>
			</div>

			<!-- Foto profil -->
			<div class="col-xl-3 col-lg-3">
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
			<div class="col-xl-6 col-lg-6">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">My Account</h6> <small class="text-info">MULAI BERGABUNG: <?= $tgl ?></small>
					</div>
					<!-- Card Body -->
					<div class="card-body">

						<form action="<?= site_url('dashboard/accountupdate') ?>" method="post">
							<div class="form-group">
								<label for="user_id">ID User*</label>
								<input type="text" name="user_id" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->user_id ?>" readonly>
							</div>
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
										<input type="email" name="username" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->username ?>">
										<?= form_error('username') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
										<label for="password">Password*</label>
										<input type="password" name="password" class="form-control form-control-sm" value="<?= $this->input->post('password') ?>">
										<small class="text-info" style="font-size: 12px;">(Kosongkan jika tidak ingin dirubah.)</small>
										<?= form_error('password') ?>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
										<label for="passconf">Ulangi Password*</label>
										<input type="password" name="passconf" class="form-control form-control-sm" value="<?= $this->input->post('passconf') ?>">
										<small class="text-info" style="font-size: 12px;">(Kosongkan jika "Password" tidak dirubah.)</small>
										<?= form_error('passconf') ?>
									</div>
								</div>
							</div>
							<div class="mt-4 text-center small">
								<button type="submit" class="btn btn-facebook btn-block btn-sm">Update Account</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	<?php endif ?>
	<!-- endif menu dashboard untuk level 2 -->

</div>
<!-- /.container-fluid -->