<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat Datang, <?= $user_login['nama_karyawan'] ?>! 🎉</h5>
            <p class="mb-4">
              Sistem Informasi Rencana Kerja Puskesmas (Sirekap) <span class="fw-bold">Jatiwangi</span>
              adalah aplikasi yang digunakan untuk melakukan managemen kegiatan Puskesmas <span
                class="fw-bold">Jatiwangi</span>.
            </p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="<?= base_url('assets') ?>/assets/img/illustrations/man-with-laptop-light.png" height="140"
              alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-user"></i></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Jumlah Pengguna</span>
              <h4 class="card-title mb-2"><?= $total_karyawan ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-task"></i></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Jumlah Kerangka Acuan Kerja</span>
              <h4 class="card-title mb-2"><?= $total_kak ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-info"><i class="bx bx-check"></i></span>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Jumlah KAK Yang Disetujui</span>
              <h4 class="card-title mb-2"><?= $total_kak_disetujui ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-4 order-1 ">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img src="<?= base_url('assets') ?>/assets/img/icons/unicons/chart-success.png" alt="chart success"
                    class="rounded" />
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Jumlah Kerangka Acuan Kerja Berjalan</span>
              <h4 class="card-title mb-2"><?= $total_kak_berjalan ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Revenue -->
  <div class="col-8 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
          <h5 class="card-header m-0 me-2 pb-3">Grafik Kinerja</h5>
          <div class="row justify-content-end mx-3">
            <div class="col-md-3 d-flex align-items-center">
              <select class="form-select me-2" name="tahun_kinerja" id="tahun_kinerja">
                <option value="2025">2025</option>
                <option value="2026">2026</option>
              </select>
              <button class="btn btn-primary" id="cariButton">Cari</button>
            </div>
          </div>

          <div id="totalRevenueChart" class="px-2"></div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Status Kegiatan</h5>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <?php foreach ($statusKegiatan as $kegiatan): ?>
            <li class="d-flex pb-3">
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0"><?= $kegiatan['nama_kegiatan'] ?></h6>
                  <small class="text-muted d-block mb-1"><?= date('d F Y', strtotime($kegiatan['created_at'])) ?></small>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <span
                    class="badge bg-label-<?php
                    if ($kegiatan['status'] == 'Diproses') {
                      echo 'primary';
                    } else if ($kegiatan['status'] == 'Diterima') {
                      echo 'danger';
                    } else if ($kegiatan['status'] == 'Menunggu Persetujuan LPJ') {
                      echo 'warning';
                    } else if ($kegiatan['status'] == 'Perlu Diperbaiki') {
                      echo 'warning';
                    } else if ($kegiatan['status'] == 'Selesai') {
                      echo 'success';
                    } else {
                      echo 'danger';
                    } ?> me-1"><?= ($kegiatan['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $kegiatan['status'] ?></span>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->

</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Kinerja Tiap Unit</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2"><?= $total_kak ?></h2>
            <span>Kegiatan</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-health"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Esensial dan Keperawatan Kesehatan Masyarakat</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold"><?= $jumlahKegiatanUnitEKKM ?> Kegiatan</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class="bx bx-search"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Pengembangan</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold"><?= $jumlahKegiatanUnitPengembangan ?> Kegiatan</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Kefarmasian & Labolatorium</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold"><?= $jumlahKegiatanUnitKL ?> Kegiatan</small>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Expense Overview -->
  <div class="col-lg-6 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= base_url('assets') ?>/assets/img/icons/unicons/cc-warning.png" alt="chart success"
                  class="rounded" />
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Jumlah Pagu Anggaran Tahun 2025</span>
            <h4 class="card-title mb-2">Rp<?= number_format($jumlahPaguAnggaran, 0, ',', '.') ?></h4>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?= base_url('assets') ?>/assets/img/icons/unicons/cc-success.png" alt="chart success"
                  class="rounded" />
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Jumlah Anggaran Yang Digunakan</span>
            <h4 class="card-title mb-2">Rp<?= number_format($jumlahAnggaranDigunakan, 0, ',', '.') ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jscart') ?>
<script src="<?= base_url('assets') ?>/assets/js/chartConfig.js"></script>
<?= $this->endSection() ?>