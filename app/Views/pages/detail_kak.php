<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h3 class="card-header text-center mt-3">Detail Kerangka Acuan Kerja</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible text-center mx-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="row mx-4 mb-5">
        <div class="col-md-12">
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
                    <td><span
                            class="badge bg-label-<?php
                            if ($kak['status'] == 'Diproses') {
                                echo 'primary';
                            } else if ($kak['status'] == 'Diterima') {
                                echo 'danger';
                            } else if ($kak['status'] == 'Menunggu Persetujuan LPJ') {
                                echo 'warning';
                            } else if ($kak['status'] == 'Perlu Diperbaiki') {
                                echo 'warning';
                            } else if ($kak['status'] == 'Selesai') {
                                echo 'success';
                            } else {
                                echo 'danger';
                            } ?> me-1"><?= ($kak['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $kak['status'] ?></span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col mt-4">
                <?php if ($user_login['role'] != 'Staf Unit'): ?>
                    <?php if ($kak['status'] == 'Diterima'): ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter">Batal Validasi
                            Kerangka Acuan Kerja</button>
                    <?php elseif ($kak['status'] == 'Selesai'): ?>
                    <?php else: ?>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCenter">Validasi Kerangka
                            Acuan Kerja</button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Validasi Kerangka Acuan Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('kak/validasi') ?>" method="post">
                        <input type="text" name="id_kak" value="<?= $kak['id_kak'] ?>" hidden>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-0">
                                    <div class="form-floating my-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="Rp."
                                            aria-describedby="floatingInputHelp" name="anggaran_disetujui"
                                            value="<?= $kak['anggaran_disetujui'] ?>">
                                        <label for="floatingInput">Anggaran Yang Disetujui</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-0">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example" style="height: 55px" name="status">
                                        <option value="Diproses" <?= ($kak['status'] == 'Diproses') ? 'selected' : '' ?>>
                                            Diproses</option>
                                        <option value="Diterima" <?= ($kak['status'] == 'Diterima') ? 'selected' : '' ?>>
                                            Diterima</option>
                                        <option value="Perbaikan" <?= ($kak['status'] == 'Perbaikan') ? 'selected' : '' ?>>
                                            Perbaikan</option>
                                        <option value="Ditolak" <?= ($kak['status'] == 'Ditolak') ? 'selected' : '' ?>>
                                            Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Kembali
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>