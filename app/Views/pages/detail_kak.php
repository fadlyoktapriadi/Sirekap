<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h3 class="card-header text-center mt-3">Detail Kerangka Acuan Kerja</h3>

    <div class="row mx-4 mb-5">
        <div class="col-md-10">
        <h4>Program Kerja</h4>
        <table class="table">
            <tr>
                <td>Jenis Program Kerja</td>
                <td><?= $kak['nama_proker'] ?></td>
            </tr>
            <tr>
                <td>Deskripsi Program Kerja</td>
                <td><?= $kak['deskripsi'] ?></td>
            </tr>
            <tr>
                <td>Tujuan Program Kerja</td>
                <td><?= $kak['tujuan'] ?></td>
            </tr>
        </table>

        <h4 class="mt-4">Kegiatan</h4>
        <table class="table">
            <tr>
                <td>Nama Kegiatan</td>
                <td><?= $kak['nama_kegiatan'] ?></td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td><?= $kak['lokasi'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td><?= date('d F Y', strtotime($kak['tanggal_mulai'])) ?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td><?= date('d F Y', strtotime($kak['tanggal_selesai'])) ?></td>
            </tr>
            <tr>
                <td>Anggaran Yang Dibutuhkan</td>
                <td>Rp<?= number_format($kak['anggaran_dibutuhkan'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Anggaran Yang Disetujui</td>
                <td>Rp<?= number_format($kak['anggaran_disetujui'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Penanggung Jawab</td>
                <td><?= $kak['nama_karyawan'] ?></td>
            </tr>
            <tr>
                <td>Sasaran</td>
                <td><?= $kak['sasaran'] ?></td>
            </tr>
            <tr>
                <td>Target</td>
                <td><?= $kak['target'] ?> Pasien</td>
            </tr>
            <tr>
                <td>File Kerangka Acuan Kerja (KAK)</td>
                <td><a href="<?= base_url('doc/') . $kak['file'] ?>" target="_blank"><?= $kak['file'] ?></a></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><span class="badge bg-label-<?php
                        if ($kak['status'] == 'Diproses') {
                            echo 'primary';
                        } else if ($kak['status'] == 'Diterima') {
                            echo 'info';
                        } else if ($kak['status'] == 'Perbaikan') {
                            echo 'warning';
                        } else if ($kak['status'] == 'Selesai') {
                            echo 'success';
                        } else {
                            echo 'danger';
                        } ?> me-1"><?= $kak['status'] ?></span></td>
                <td>
            </tr>
        </table>
            </div>
        </div>

</div>

<?= $this->endSection() ?>