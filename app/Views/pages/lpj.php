<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Lembar Pertanggung Jawaban</h5>
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

    <div class="d-flex justify-content-end">
        <button class="btn btn-outline-primary mx-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalCenter"
            style="margin-bottom: 0px; height: 38px;">Filter
            Data</button>
    </div>
    <div class="table-responsive text-nowrap mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Unit Kerja</th>
                    <th>Penanggung Jawab</th>
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
                        <td><?= $item['unit_kerja'] ?></td>
                        <td><?= $item['nama_karyawan'] ?></td>
                        <td><span
                                class="badge bg-label-<?php
                                if ($item['status'] == 'Diproses') {
                                    echo 'primary';
                                } else if ($item['status'] == 'Diterima') {
                                    echo 'danger';
                                } else if ($item['status'] == 'Menunggu Persetujuan LPJ') {
                                    echo 'warning';
                                } else if ($item['status'] == 'Perlu Diperbaiki') {
                                    echo 'warning';
                                } else if ($item['status'] == 'Selesai') {
                                    echo 'success';
                                } else {
                                    echo 'danger';
                                } ?> me-1"><?= ($item['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $item['status'] ?></span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <?php if ($item['status'] == 'Diterima'): ?>
                                        <a class="dropdown-item" href="<?= base_url('lpj/tambah/') . $item['id_kak'] ?>"><i
                                                class="bx bx-pencil me-1"></i>
                                            Input LPJ</a>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?= base_url('lpj/detail/') . $item['id_kak'] ?>"><i
                                                class="bx bx-detail me-1"></i>
                                            Detail</a>
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
            <form action="<?= base_url('lpj/filter') ?>" method="post">
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
<?= $this->endSection() ?>