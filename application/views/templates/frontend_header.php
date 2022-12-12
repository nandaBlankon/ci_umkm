<!doctype html>
<html lang="en">

<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/frontend/dist/'); ?>assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/frontend/dist/'); ?>assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/frontend/dist/'); ?>assets/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="<?= base_url('assets/frontend/dist/'); ?>assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/dist/'); ?>assets/css/libs.bundle.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/dist/'); ?>assets/css/theme.bundle.css" />

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Fix for custom scrollbar if JS is disabled-->
    <noscript>
        <style>
            /**
          * Reinstate scrolling for non-JS clients
          */
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>

    <!-- Page Title -->
    <title><?= $title; ?></title>

</head>

<body class="">

    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mx-0 p-0 flex-column  border-0">
        <div class="w-100 pb-lg-0 pt-lg-0 pt-4 pb-3">
            <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

                <!-- Logo-->
                <a class="navbar-brand fw-bold fs-3 m-0 p-0 flex-shrink-0" href="<?= base_url(''); ?>">
                    <!-- Start of Logo-->
                    <div class="d-flex align-items-center">
                        <div class="f-w-6 d-flex align-items-center me-2 lh-1">
                            <img src="<?= base_url('assets/frontend/'); ?>homeindustri.png" class=" img-responsive">
                        </div>
                    </div>
                    <!-- / Logo-->

                </a>
                <!-- / Logo-->

                <!-- Main Navigation-->
                <div class="ms-5 flex-shrink-0 collapse navbar-collapse navbar-collapse-light w-auto flex-grow-1" id="navbarNavDropdown">

                    <!-- Mobile Nav Toggler-->
                    <button class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 position-absolute top-0 end-0 mt-3 me-2" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ri-close-circle-line ri-2x"></i>
                    </button>
                    <!-- / Mobile Nav Toggler-->

                    <ul class="navbar-nav py-lg-2 mx-auto">
                        <li class="nav-item me-lg-4">
                            <a class="nav-link fw-bolder py-lg-4" href="<?= base_url(''); ?>">
                                Home
                            </a>
                        </li>
                        <li class="nav-item me-lg-4">
                            <a class="nav-link fw-bolder py-lg-4" href="#">
                                About Us
                            </a>
                        </li>
                        <?php if ($this->session->userdata('user_id')) { ?>
                            <li class="nav-item dropdown me-lg-4">
                                <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu Anda
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('transaksi/transaksiSaya'); ?>">Transaksi Saya</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('keluar'); ?>">Keluar</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item dropdown me-lg-4">
                                <a class="nav-link fw-bolder dropdown-toggle py-lg-4" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Masuk | Daftar
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('login'); ?>">Masuk</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('daftar'); ?>">Daftar</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- / Main Navigation-->

                <!-- Navbar Icons-->
                <ul class="list-unstyled mb-0 d-flex align-items-center">

                    <!-- Navbar Toggle Icon-->
                    <li class="d-inline-block d-lg-none">
                        <button class="btn btn-link px-2 text-decoration-none navbar-toggler border-0 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ri-menu-line ri-lg align-middle"></i>
                        </button>
                    </li>
                    <!-- /Navbar Toggle Icon-->

                    <?php if ($this->session->userdata('user_id')) : ?>
                        <!-- Navbar Cart-->
                        <li class="ms-1 d-inline-block position-relative">
                            <button class="btn btn-link px-2 text-decoration-none d-flex align-items-center disable-child-pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <i class="ri-shopping-cart-2-line ri-lg align-middle position-relative z-index-10"></i>
                                <span class="fs-xs fw-bolder f-w-5 f-h-5 bg-orange rounded-lg d-block lh-1 pt-1 position-absolute top-0 end-0 z-index-20 mt-2 text-white"><?= $this->cart->total_items(); ?></span>
                            </button>
                        </li>
                        <!-- /Navbar Cart-->

                        <!-- Navbar dashboard-->
                        <li class="ms-1 d-none d-lg-inline-block">
                            <a class="btn btn-link px-2 text-decoration-none d-flex align-items-center" href="<?= base_url('dashboard'); ?>" title="Ke Dashboard">
                                <i class="ri-dashboard-line ri-lg align-middle"></i>
                            </a>
                        </li>
                        <!-- /Navbar dashboard-->
                    <?php endif ?>

                </ul>
                <!-- Navbar Icons-->

            </div>
        </div>
    </nav>
    <!-- / Navbar-->
    <!-- / Navbar-->