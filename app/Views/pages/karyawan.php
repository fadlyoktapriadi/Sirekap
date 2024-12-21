<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Karyawan</h5>

    <div class="table-responsive text-nowrap mt-3 mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $user['NIP'] ?></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong><?= $user['nama_pengguna'] ?></strong>
                        </td>
                        <td><?= $user['role'] ?></td>
                        <td><?= $user['unit_kerja'] ?></td>
                    </tr>
                    <?php
                    $i++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>