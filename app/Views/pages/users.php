<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Pengguna</h5>
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
        <a href="<?= base_url("/users/tambah") ?>">
            <button class="btn btn-outline-success mx-4" style="margin-bottom: 0px; height: 38px;">Tambah
                Pengguna</button>
        </a>
    </div>
    <div class="table-responsive text-nowrap mt-3 mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong><?= $user['nama_pengguna'] ?></strong>
                        </td>
                        <td><?= $user['username'] ?></td>
                        <td><span class="badge bg-label-primary me-1"><?= $user['role'] ?></span></td>
                        <td><?= date('d F Y', strtotime($user['created_at'])) ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= base_url('users/edit/') . $user['id_pengguna'] ?>"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item hapusbtn"
                                        href="<?= base_url('users/hapus/') . $user['id_pengguna'] ?>"><i
                                            class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets') ?>/assets/js/hapusalert.js"></script>
<?= $this->endSection() ?>