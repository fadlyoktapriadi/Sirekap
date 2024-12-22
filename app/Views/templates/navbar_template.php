<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="<?= base_url('assets') ?>/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?= $title ?> | Sirekap</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logopuskes.png') ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/vendor/css/core.css"
    class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/vendor/css/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= base_url('assets') ?>/assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= base_url('assets') ?>/assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="<?= base_url('assets/images/logopuskes.png') ?>" alt="" width="40">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">sirekap</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <?php if ($user_login['role'] == 'Kepala Puskesmas'): ?>
            <li
              class="menu-item <?= ($title == 'Data Program Kerja' || $title == 'Tambah Program Kerja' || $title == 'Edit Program Kerja') ? 'active' : '' ?>">
              <a href=" <?= base_url('proker') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Documentation">Data Program Kerja</div>
              </a>
            </li>
            <li class="menu-item <?= ($title == 'Data Karyawan') ? 'active' : '' ?>">
              <a href=" <?= base_url('karyawan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Documentation">Data Karyawan</div>
              </a>
            </li>
          <?php endif; ?>

          <li
            class="menu-item <?= ($title == 'Data Kerangka Acuan Kerja' || $title == 'Tambah Kerangka Acuan Kerja' || $title == 'Edit Kerangka Acuan Kerja') ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-task"></i>
              <div data-i18n="Layouts">Kegiatan</div>
            </a>

            <ul class="menu-sub">
              <li
                class="menu-item <?= ($title == 'Data Kerangka Acuan Kerja' || $title == 'Tambah Kerangka Acuan Kerja' || $title == 'Edit Kerangka Acuan Kerja') ? 'active open' : '' ?>">
                <a href="<?= base_url('kak') ?>" class="menu-link">
                  <div data-i18n="Without menu">Kerangka Acuan Kerja (KAK)</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                  <div data-i18n="Without navbar">LPJ KAK</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-container.html" class="menu-link">
                  <div data-i18n="Container">Riwayat KAK</div>
                </a>
              </li>
            </ul>
          </li>

          <?php if ($user_login['role'] == 'Administrator'): ?>
            <li
              class="menu-item <?= ($title == 'User Management' || $title == 'Tambah User' || $title == 'Edit User') ? 'active' : '' ?>">
              <a href=" <?= base_url('users') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Documentation">User Management</div>
              </a>
            </li>
          <?php endif; ?>

          <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>

          <li class="menu-item">
            <a href="<?= base_url('logout') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-log-out"></i>
              <div data-i18n="Documentation">Logout</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center mt-3">
                <h4 class="d-none d-md-block">Sistem Informasi Rencana Kerja Puskesmas Jatiwangi</h4>
                <h4 class="d-block d-md-none">Sirekap</h4>
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?= base_url('assets/images/user.png') ?>" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?= base_url('assets/images/user.png') ?>" alt
                              class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?= $user_login['nama_pengguna'] ?></span>
                          <small class="text-muted"><?= $user_login['role'] ?></small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?= base_url('logout') ?>">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <?php if (isset($breadcrumb)): ?>
              <h5 class="fw-bold py-1 mb-4"><span class="text-muted fw-light">
                  <span class="text-muted fw-light">
                    <?= implode(' / ', $breadcrumb) ?>
                  </span>
              </h5>
            <?php endif; ?>

            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- / Content -->
          </div>
        </div>


        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              made with ❤️ by
              <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Anita Zahara</a>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?= base_url('assets') ?>/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url('assets') ?>/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url('assets') ?>/assets/vendor/js/bootstrap.js"></script>
  <script src="<?= base_url('assets') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="<?= base_url('assets') ?>/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= base_url('assets') ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="<?= base_url('assets') ?>/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="<?= base_url('assets') ?>/assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- DataTables JS -->
  <script src="https:////cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable({
        columnDefs: [{
          "defaultContent": "-",
          "targets": "_all"
        }],
        bLengthChange: true,
        lengthMenu: [[10, 25, -1], [10, 25, 50, "All"]],
        bFilter: true,
        bSort: true,
        bPaginate: true
      });
    });    
  </script>
</body>

</html>