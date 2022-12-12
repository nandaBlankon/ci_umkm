<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-laugh-wink"></i>
			</div>
			<div class="sidebar-brand-text mx-3"><?= $this->fungsi->user_login()->nama; ?></div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item <?php if (isset($act_dashboard)) {
								echo $act_dashboard;
							} ?>">
			<a class="nav-link" href="<?= base_url('dashboard'); ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">
		<!-- START MENU ADMIN -->
		<?php if ($this->fungsi->user_login()->level == 1) : ?>
			<!-- Heading -->
			<div class="sidebar-heading">
				Marketplace
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item <?php if (isset($act_kategori)) {
									echo $act_kategori;
								} ?>">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-folder"></i>
					<span>Kategori</span>
				</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item <?php if (isset($act_kategori1)) {
													echo $act_kategori1;
												} ?>" href="<?= base_url('kategori'); ?>">Data kategori</a>
						<a class="collapse-item <?php if (isset($act_kategori2)) {
													echo $act_kategori2;
												} ?>" href="<?= base_url('kategori/tambah'); ?>">Tambah kategori</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Utilities Collapse Menu -->
			<li class="nav-item <?php if (isset($act_produk)) {
									echo $act_produk;
								} ?>">
				<a class="nav-link" href="<?= base_url('produk'); ?>">
					<i class="fas fa-fw fa-cart-arrow-down"></i>
					<span>Produk</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Pengguna
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item <?php if (isset($act_lapPenjual)) {
									echo $act_lapPenjual;
								} ?>">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
					<i class="fas fa-fw fa-store-alt"></i>
					<span>Penjual</span>
				</a>
				<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="<?= base_url('usaha/lapPenjual/umkm'); ?>">UMKM</a>
						<a class="collapse-item" href="<?= base_url('usaha/lapPenjual/homeIndustri'); ?>">Home Industri</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Transaksi pengguna -->
			<li class="nav-item <?php if (isset($act_laporanTransaksiPenjual)) {
									echo $act_laporanTransaksiPenjual;
								} ?>">
				<a class="nav-link" href="<?= base_url('transaksi/laporanTransaksiPenjual'); ?>">
					<i class="fas fa-fw fa-credit-card"></i>
					<span>Transaksi</span></a>
			</li>

			<!-- Nav Item - Akun Pengguna -->
			<li class="nav-item <?php if (isset($act_user)) {
									echo $act_user;
								} ?>">
				<a class="nav-link" href="<?= base_url('user'); ?>">
					<i class="fas fa-fw fa-users"></i>
					<span>Akun Pengguna</span></a>
			</li>
		<?php endif ?>
		<!-- END MENU ADMIN -->

		<!-- START MENU PENGGUNA BIASA -->
		<?php if ($this->fungsi->user_login()->level == 2) : ?>
			<div class="sidebar-heading">
				Menu Anda
			</div>
			<li class="nav-item <?php if (isset($act_profil)) {
									echo $act_profil;
								} ?>">
				<a class="nav-link" href="<?= base_url('dashboard/profil'); ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Profil Saya</span></a>
			</li>

			<li class="nav-item <?php if (isset($act_transaksi)) {
									echo $act_transaksi;
								} ?>">
				<a class="nav-link" href="<?= base_url('transaksi/transaksiSaya'); ?>">
					<i class="fas fa-fw fa-credit-card"></i>
					<span>Transaksi Saya</span></a>
			</li>

			<?php if ($usahaSaya != null) : ?>
				<li class="nav-item <?php if (isset($act_transaksiP)) {
										echo $act_transaksiP;
									} ?>">
					<a class="nav-link" href="<?= base_url('transaksi/transaksiPelanggan'); ?>">
						<i class="fas fa-fw fa-cart-plus"></i>
						<span>Transaksi Pelanggan</span></a>
				</li>
				<li class="nav-item <?php if (isset($act_usaha)) {
										echo $act_usaha;
									} ?>">
					<a class="nav-link" href="<?= base_url('usaha/usahaSaya'); ?>">
						<i class="fas fa-fw fa-store"></i>
						<span>Usaha Saya</span></a>
				</li>
			<?php endif ?>
		<?php endif ?>
		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

	</ul>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

				<!-- Sidebar Toggle (Topbar) -->
				<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
				</button>

				<!-- Topbar Navbar -->
				<ul class="navbar-nav ml-auto">

					<!-- Nav Item - Search Dropdown (Visible Only XS) -->
					<li class="nav-item dropdown no-arrow d-sm-none">
						<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-search fa-fw"></i>
						</a>
						<!-- Dropdown - Messages -->
						<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
							<form class="form-inline mr-auto w-100 navbar-search">
								<div class="input-group">
									<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">
											<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</li>

					<!-- Nav Item - Alerts -->
					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-bell fa-fw"></i>
							<!-- Counter - Alerts -->
							<span class="badge badge-danger badge-counter">3+</span>
						</a>
						<!-- Dropdown - Alerts -->
						<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
							<h6 class="dropdown-header">
								Alerts Center
							</h6>
							<a class="dropdown-item d-flex align-items-center" href="#">
								<div class="mr-3">
									<div class="icon-circle bg-primary">
										<i class="fas fa-file-alt text-white"></i>
									</div>
								</div>
								<div>
									<div class="small text-gray-500">December 12, 2019</div>
									<span class="font-weight-bold">A new monthly report is ready to download!</span>
								</div>
							</a>
							<a class="dropdown-item d-flex align-items-center" href="#">
								<div class="mr-3">
									<div class="icon-circle bg-success">
										<i class="fas fa-donate text-white"></i>
									</div>
								</div>
								<div>
									<div class="small text-gray-500">December 7, 2019</div>
									$290.29 has been deposited into your account!
								</div>
							</a>
							<a class="dropdown-item d-flex align-items-center" href="#">
								<div class="mr-3">
									<div class="icon-circle bg-warning">
										<i class="fas fa-exclamation-triangle text-white"></i>
									</div>
								</div>
								<div>
									<div class="small text-gray-500">December 2, 2019</div>
									Spending Alert: We've noticed unusually high spending for your account.
								</div>
							</a>
							<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
						</div>
					</li>

					<!-- Nav Item - Messages -->


					<div class="topbar-divider d-none d-sm-block"></div>

					<!-- Nav Item - User Information -->
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->fungsi->user_login()->nama; ?></span>
							<?php if ($this->fungsi->user_login()->image == null) { ?>
								<img class="img-profile rounded-circle" src="<?= base_url('assets/backend/'); ?>img/undraw_profile.svg">
							<?php } else { ?>
								<img class="img-profile rounded-circle" src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image); ?>">
							<?php } ?>
						</a>
						<!-- Dropdown - User Information -->
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							<!-- <a class="dropdown-item" href="">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Profil
							</a>
							<a class="dropdown-item" href="#">
								<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
								Settings
							</a>
							<a class="dropdown-item" href="#">
								<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
								Activity Log
							</a> -->
							<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" href="<?= base_url('keluar'); ?>" data-toggle="modal" data-target="#logoutModal">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								Keluar
							</a>
						</div>
					</li>

				</ul>

			</nav>
			<!-- End of Topbar -->