<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-sidebar-visibility="show" data-layout-style="default" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed">

<head>

    <meta charset="utf-8" />
    <title>EPA | Kementerian Agama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Pelaporan Penyuluh Agama Kementerian Agama RI" name="description" />
    <meta content="Danunih" name="author" />
    <link rel="shortcut icon" href="<?= base_url()?>assets/images/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="<?= base_url()?>assets/js/layout.js"></script>
    <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style media="screen">
  	#loverlay{
  	position: fixed;
  	top: 0;
  	z-index: 100000;
  	width: 100%;
  	height:100%;
  	display: none;
  	background: rgba(0,0,0,0.6);
  	}
  	.cv-spinner {
  	height: 100%;
  	display: flex;
  	justify-content: center;
  	align-items: center;
  	}
  	.spinner {
  	width: 40px;
  	height: 40px;
  	border: 4px #ddd solid;
  	border-top: 4px #2e93e6 solid;
  	border-radius: 50%;
  	animation: sp-anime 0.8s infinite linear;
  	}
  	@keyframes sp-anime {
  	100% {
  		transform: rotate(360deg);
  	}
  	}
  	.is-hide{
  	display:none;
  	}
    .progressx {
      width: 100px;
    	height: 40px;
      margin-top: 25px;
      padding-left: 10px;
      color: #fff;
  	}
  	</style>
    <?= $this->renderSection('style') ?>
</head>

<body>
  <div id="loverlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
    <span class="progressx">Loading...</span>
  </div>
  </div>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= site_url()?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="30">
                        </span>
                    </a>

                    <a href="<?= site_url()?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="30">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">






                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?= base_url()?>assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= session('nama')?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Founder</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome <?= session('nama')?></h6>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div>
    </div>
</div>

        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?= site_url()?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?= site_url()?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url()?>assets/images/logo_epa.png" alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= site_url()?>">
                                <i class="ri-account-circle-line"></i> <span data-key="t-dashboards">Profil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= site_url('laporan')?>">
                                <i class="ri-file-line"></i> <span data-key="t-dashboards">Laporan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= site_url('laporan/lain')?>">
                                <i class="ri-file-3-line"></i> <span data-key="t-dashboards">Laporan Lainnya</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= site_url('laporan/rekapitulasi')?>">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Rekapitulasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarSasaran" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSasaran">
                                <i class="ri-file-text-line"></i> <span data-key="t-landing">Sasaran</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarSasaran">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= site_url('sasaran/umum')?>" class="nav-link" data-key="t-one-page"> Sasaran Umum </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= site_url('sasaran/khusus')?>" class="nav-link" data-key="t-nft-landing"> Sasaran Khusus </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarKinerja" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarKinerja">
                                <i class="ri-file-text-fill"></i> <span data-key="t-landing">Kinerja</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarKinerja">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= site_url('pendataan')?>" class="nav-link" data-key="t-nft-landing"> Pendataan </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= site_url('laporan/kasus')?>" class="nav-link" data-key="t-nft-landing"> Deteksi Dini </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDownload" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDownload">
                                <i class="ri-file-download-line"></i> <span data-key="t-landing">Download</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDownload">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= site_url('download/regulasi')?>" class="nav-link" data-key="t-nft-landing"> Regulasi </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= site_url('download/materi')?>" class="nav-link" data-key="t-nft-landing"> Materi </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>

        <div class="vertical-overlay"></div>

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
                            <script>document.write(new Date().getFullYear())</script> © e-PA.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                by Subdit Penyuluh
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <script src="<?= base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url()?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url()?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url()?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url()?>assets/js/plugins.js"></script>
    <script src="<?= base_url()?>assets/libs/select2/select2.min.js"></script>

    <script src="<?= base_url()?>assets/js/app.js"></script>
    <script type="text/javascript">
      var site_url = '<?= site_url()?>';

      function alert($text) {
        Toastify({
          text: $text,
          duration: 5000,
          newWindow: true,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
          style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
          onClick: function(){} // Callback after click
        }).showToast();
      }

      <?php
      if(session()->getFlashdata('message')){
        ?>
        alert("<?= session()->getFlashdata('message')?>");
        <?php
      }
      ?>

      function loader() {
        $("#loverlay").fadeIn(300);
      }
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>
