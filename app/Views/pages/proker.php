<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Program Kerja</h5>
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

    <div class="d-flex justify-content-start">
        <a href="<?= base_url("/proker/tambah") ?>">
            <button class="btn btn-outline-success mx-4 mt-2" style="margin-bottom: 0px; height: 38px;">Tambah
                Program Kerja</button>
        </a>
    </div>
    <div class="table-responsive text-nowrap mt-4 mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Program Kerja</th>
                    <th>Tujuan</th>
                    <th>Dibuat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                foreach ($proker as $item): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item['nama_proker'] ?></td>
                        <td><?= $item['tujuan'] ?></td>
                        <td><?= $item['created_at'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= base_url('proker/edit/') . $item['id_proker'] ?>"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item hapusbtn"
                                        href="<?= base_url('proker/hapus/') . $item['id_proker'] ?>"><i
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