<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Detail Realisasi Anggaran</h5>
    <div class="card-body">
        <form action="<?= base_url('laporan/realisasi-anggaran') ?>" method="get">
            <div class="row justify-content-end my-3">
                <div class="col-md-2 d-flex align-items-center">
                    <select class="form-select me-2" name="bulan" id="bulan_kinerja" required>
                        <option value="">Pilih Bulan</option>
                        <?php
                        $bulan = [
                            'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        ];
                        foreach ($bulan as $key => $value): ?>
                            <option value="<?= $key + 1 ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-primary" id="cariButton">Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive text-nowrap mx-4">

            <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Unit Kerja</th>
                        <th>Anggaran Disetujui</th>
                        <th>Realisasi Anggaran</th>
                        <th>Sisa Anggaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    $no = 1;
                    foreach ($anggaran as $item): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['nama_kegiatan'] ?></td>
                            <td><?= $item['unit_kerja'] ?></td>
                            <td>Rp<?= number_format($item['anggaran_disetujui'], 0, ',', '.') ?></td>
                            <td>Rp<?= number_format($item['anggaran_digunakan'], 0, ',', '.') ?></td>
                            <td>Rp<?= number_format($item['anggaran_disetujui'] - $item['anggaran_digunakan'], 0, ',', '.') ?>
                            </td>
                            <td><span
                                    class="badge bg-label-<?php
                                    if ($item['status'] == 'Diterima') {
                                        echo 'info';
                                    } else if ($item['status'] == 'Menunggu Persetujuan LPJ') {
                                        echo 'warning';
                                    } else if ($item['status'] == 'Perlu Perbaikan LPJ') {
                                        echo 'warning';
                                    } else if ($item['status'] == 'Selesai') {
                                        echo 'success';
                                    } else {
                                        echo 'danger';
                                    } ?> me-1"><?= ($item['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $item['status'] ?></span>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h5 class="mt-3">Resume Pagu Anggaran</h5>

        <div class="row">
            <div class="col">
                <div class="table-responsive text-nowrap mx-4">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tahun Anggaran</th>
                                <th>Pagu Anggaran</th>
                                <th>Realisasi Anggaran</th>
                                <th>Sisa Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td><?= date('Y') ?></td>
                                <td>Rp<?= number_format($jumlahPaguAnggaran + $jumlahAnggaranDigunakan, 0, ',', '.') ?>
                                </td>
                                <td>Rp<?= number_format($jumlahAnggaranDigunakan, 0, ',', '.') ?></td>
                                <td>Rp<?= number_format($jumlahPaguAnggaran, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>