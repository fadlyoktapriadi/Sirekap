<?= $this->extend('templates/home_template') ?>

<?= $this->section('content') ?>

<!-- Content -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="<?= base_url() ?>" class="app-brand-link gap-2">
              <img src="<?= base_url('assets/images/logopuskes.png') ?>" alt="" width="60">
              <span class="app-brand-text demo text-body fw-bolder">Sirekap</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-4">Selamat datang di <br> Sistem Rencana Kerja Puskesmas Jatiwangi! 👋</h4>
          <p class="mb-2">Silahkan login dengan mengisi kolom berikut</p>

          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible text-center">
              <?= session()->getFlashdata('error') ?>
            </div>
          <?php endif; ?>

          <form id="formAuthentication" class="mb-3" action="<?= base_url('login') ?>" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" id="email" name="username" placeholder="Masukan username anda"
                autofocus required />
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>