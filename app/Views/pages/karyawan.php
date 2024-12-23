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
                    <th>Unit Kerja</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1;
                foreach ($karyawan as $item): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $item['NIP'] ?></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                            <strong><?= $item['nama_karyawan'] ?></strong>
                        </td>
                        <td><?= $item['unit_kerja'] ?></td>
                        <td><?= $item['jabatan'] ?></td>
                    </tr>
                    <?php
                    $i++;
                endforeach ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>