<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>e-PA | Kementerian Agama RI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Penyuluh Agama Kementerian Agama Republik Indonesia" name="description" />
  <meta content="Danunih" name="author" />
  <link rel="shortcut icon" href="<?= base_url()?>/assets/images/favicon.ico">
  <link href="<?= base_url()?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <link href="<?= base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url()?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
  <?= $this->renderSection('style') ?>
</head>


<body>

  <!-- <body data-layout="horizontal" data-topbar="colored"> -->
  <!-- Begin page -->
  <div id="layout-wrapper">

    <header id="page-topbar">
      <div class="navbar-header">
        <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
            <a href="index" class="logo logo-dark">
              <span class="logo-sm">
                <img src="<?= base_url()?>/assets/images/logo-sm.png" alt="" height="22">
              </span>
              <span class="logo-lg">
                <img src="<?= base_url()?>/assets/images/logo-dark.png" alt="" height="20">
              </span>
            </a>

            <a href="index" class="logo logo-light">
              <span class="logo-sm">
                <img src="<?= base_url()?>/assets/images/logo-sm.png" alt="" height="22">
              </span>
              <span class="logo-lg">
                <img src="<?= base_url()?>/assets/images/logo-light.png" alt="" height="20">
              </span>
            </a>
          </div>

          <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
          </button>

          <!-- App Search-->
          <form class="app-search d-none d-lg-block">
            <div class="position-relative">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="uil-search"></span>
            </div>
          </form>
        </div>

        <div class="d-flex">

          <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="uil-search"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
          aria-labelledby="page-header-search-dropdown">

          <form class="p-3">
            <div class="m-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>


    <div class="dropdown d-none d-lg-inline-block ms-1">
      <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
        <i class="uil-minus-path"></i>
      </button>
    </div>

<div class="dropdown d-inline-block">
  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img class="rounded-circle header-profile-user" src="<?= base_url()?>/assets/images/users/avatar-4.jpg"
  alt="Header Avatar">
  <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?= session('nama')?></span>
  <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
</button>
<div class="dropdown-menu dropdown-menu-end">
  <!-- item-->
  <a class="dropdown-item" href="contacts-profile"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">View Profile</span></a>
  <a class="dropdown-item" href="javascript:void(0)"><i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">My Wallet</span></a>
  <a class="dropdown-item d-block" href="javascript:void(0)"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Settings</span> <span class="badge bg-success-subtle text-success rounded-pill mt-1 ms-2">03</span></a>
  <a class="dropdown-item" href="auth-lock-screen"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Lock screen</span></a>
  <a class="dropdown-item" href="<?= site_url('auth/logout')?>"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
</div>
</div>

</div>
</div>
</header>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

  <!-- LOGO -->
  <div class="navbar-brand-box">
    <a href="index" class="logo logo-dark">
      <span class="logo-sm">
        <img src="<?= base_url()?>/assets/images/logo-sm.png" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url()?>/assets/images/logo_epa.png" alt="" height="30">
      </span>
    </a>

    <a href="index" class="logo logo-light">
      <span class="logo-sm">
        <img src="<?= base_url()?>/assets/images/logo-sm.png" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url()?>/assets/images/logo-light.png" alt="" height="20">
      </span>
    </a>
  </div>

  <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
  </button>

  <div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
          <a href="<?= site_url()?>">
            <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="menu-title">Main Menu</li>

        <li>
          <a href="<?= site_url('penyuluh')?>" class="waves-effect">
            <i class="uil-calender"></i>
            <span>Data Penyuluh</span>
          </a>
        </li>

        <li>
          <a href="<?= site_url('laporan')?>" class="waves-effect">
            <i class="uil-calender"></i>
            <span>Laporan Penyuluh</span>
          </a>
        </li>

        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="uil-invoice"></i>
            <span>Master Data</span>
          </a>
          <ul class="sub-menu" aria-expanded="false">
            <li><a href="invoices-list">Agama</a></li>
            <li><a href="invoices-detail">Wilayah</a></li>
          </ul>
        </li>

        <li>
          <a href="<?= site_url('users')?>" class="waves-effect">
            <i class="uil-calender"></i>
            <span>Pengguna</span>
          </a>
        </li>

      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End --><!-- @@include("horizontal.html") -->
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">
      <?= $this->renderSection('content') ?>
    </div>
  </div>

  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          2024 © Penyuluh Agama.
        </div>
        <div class="col-sm-6">
          <div class="text-sm-end d-none d-sm-block">
            Kementerian Agama RI
          </div>
        </div>
      </div>
    </div>
  </footer>            </div>
  <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="<?= base_url()?>/assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url()?>/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url()?>/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url()?>/assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url()?>/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?= base_url()?>/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<!-- apexcharts -->
<script src="<?= base_url()?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<script src="<?= base_url()?>/assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="<?= base_url()?>/assets/js/app.js"></script>

<?= $this->renderSection('script') ?>

</body>

</html>
