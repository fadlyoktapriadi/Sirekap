<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Riwayat Lembar Pertanggung Jawaban</h5>
    <div class="table-responsive text-nowrap mt-4 mx-4">

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
                                    <a class="dropdown-item" href="<?= base_url('lpj/detail/') . $item['id_kak'] ?>"><i
                                            class="bx bx-detail me-1"></i>
                                        Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>