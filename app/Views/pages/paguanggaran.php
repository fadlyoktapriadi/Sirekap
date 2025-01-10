<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <h5 class="card-header">Pagu Anggaran</h5>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible text-center mx-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-start">
                <a href="<?= base_url("/pagu-anggaran/tambah") ?>">
                    <button class="btn btn-outline-success mx-4 mt-2" style="margin-bottom: 0px; height: 38px;">Tambah
                        Pagu Anggaran</button>
                </a>
            </div>

            <div class="table-responsive text-nowrap mt-4 mx-4">

                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Jumlah Anggaran</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        $no = 1;
                        foreach ($pagu as $item): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $item['tahun_anggaran'] ?></td>
                                <td>Rp<?= number_format($item['jumlah_anggaran'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="<?= base_url('pagu-anggaran/edit/') . $item['id_pagu_anggaran'] ?>"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item hapusbtn"
                                                href="<?= base_url('pagu-anggaran/hapus/') . $item['id_pagu_anggaran'] ?>"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="<?= base_url('assets') ?>/assets/js/hapusalert.js"></script>
        <?= $this->endSection() ?>