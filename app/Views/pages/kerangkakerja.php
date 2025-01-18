<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Kerangka Acuan Kerja</h5>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible text-center mx-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible text-center mx-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($user_login['role'] == 'Staf Unit'): ?>
        <div class="d-flex justify-content-between">
            <a href="<?= base_url("/kak/tambah") ?>">
                <button class="btn btn-outline-success mx-4 mt-2" style="margin-bottom: 0px; height: 38px;">Tambah
                    Kerangka Acuan Kerja</button>
            </a>
            <button class="btn btn-outline-primary mx-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalCenter"
                style="margin-bottom: 0px; height: 38px;">Filter Data</button>
        </div>
    <?php elseif ($user_login['role'] != 'Staf Unit'): ?>
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-primary mx-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalCenter"
                style="margin-bottom: 0px; height: 38px;">Filter
                Data</button>
        </div>
    <?php endif; ?>
    <div class="table-responsive text-nowrap mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Anggaran Yang Dibutuhkan</th>
                    <th>Penanggung Jawab</th>
                    <th>Tanggal Mengajukan</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                foreach ($kak as $item): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item['nama_kegiatan'] ?></td>
                        <td>Rp<?= number_format($item['anggaran_dibutuhkan'], 0, ',', '.') ?></td>
                        <td><?= $item['nama_karyawan'] ?></td>
                        <td><?= date('d F Y', strtotime($item['created_at'])) ?></td>
                        <td><span class="badge bg-label-<?php
                        if ($item['status'] == 'Diproses') {
                            echo 'primary';
                        } else if ($item['status'] == 'Diterima') {
                            echo 'info';
                        } else if ($item['status'] == 'Perlu Perbaikan KAK') {
                            echo 'warning';
                        } else if ($item['status'] == 'Selesai') {
                            echo 'success';
                        } else {
                            echo 'danger';
                        } ?> me-1"><?= $item['status'] ?></span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= base_url('kak/detail/') . $item['id_kak'] ?>"><i
                                            class="bx bx-detail me-1"></i>
                                        Detail</a>
                                    <?php if ($user_login['role'] == 'Staf Unit' && $item['status'] == 'Diproses'): ?>
                                        <a class="dropdown-item" href="<?= base_url('kak/edit/') . $item['id_kak'] ?>"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item hapusbtn"
                                            href="<?= base_url('kak/hapus/') . $item['id_kak'] ?>"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('kak/filter') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" style="height: 55px; padding: 10px"
                                    name="unit_kerja" required>
                                    <option selected> --Pilih Unit Kerja--</option>
                                    <option value="Esensial dan Keperawatan Kesehatan Masyarakat">Esensial dan
                                        Keperawatan
                                        Kesehatan Masyarakat</option>
                                    <option value="Pengembangan">Pengembangan</option>
                                    <option value="Kefarmasian & Laboratorium">Kefarmasian & Laboratorium</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets') ?>/assets/js/hapusalert.js"></script>
<?= $this->endSection() ?>