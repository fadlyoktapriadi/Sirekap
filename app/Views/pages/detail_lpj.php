<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <h3 class="card-header text-center mt-3">Pengisian Lembar Pertanggung Jawaban</h3>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible text-center mx-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="row mx-4 mb-5">
                    <div class="col-md-12">
                        <h4 class="mt-4">Detail Kegiatan</h4>
                        <table class="table">
                            <tr>
                                <td>Nama Kegiatan</td>
                                <td><?= $lpj['nama_kegiatan'] ?></td>
                            </tr>
                            <tr>
                                <td>Unit Kerja</td>
                                <td><?= $lpj['unit_kerja'] ?></td>
                            </tr>
                            <tr>
                                <td>Pelaksanaan</td>
                                <td><?= date('d F Y', strtotime($lpj['tanggal_mulai'])) ?> s/d
                                    <?= date('d F Y', strtotime($lpj['tanggal_selesai'])) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Anggaran Yang Disetujui</td>
                                <td>Rp<?= number_format($lpj['anggaran_disetujui'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Penanggung Jawab</td>
                                <td><?= $lpj['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <td>Sasaran</td>
                                <td><?= $lpj['sasaran'] ?></td>
                            </tr>
                            <tr>
                                <td>Target</td>
                                <td><?= $lpj['target'] ?> Pasien</td>
                            </tr>

                        </table>

                        <div class="row">
                            <div class="col">
                                <h4 class="mt-4">Lembar Pertanggung Jawaban</h4>

                                <table class="table">
                                    <tr>
                                        <td>Capaian Pelaksanaan</td>
                                        <td><?= $lpj['capaian_pelaksanaan'] ?> Pasien (
                                            <?= $lpj['capaian_pelaksanaan'] / $lpj['target'] * 100 ?>% )
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Anggaran Yang Digunakan</td>
                                        <td>Rp<?= number_format($lpj['anggaran_digunakan'], 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><?= $lpj['keterangan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dokumen Pertanggung Jawaban</td>
                                        <td>
                                            <a href="<?= base_url('doc/lpj/') . $lpj['file_lpj'] ?>" target="_blank">
                                                <?= $lpj['file_lpj'] ?>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokumentasi Kegiatan</td>
                                        <td>
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="<?= base_url('doc/dokumentasi/') . $lpj['dokumentasi'] ?>"
                                                        alt="" width="200">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><span
                                                class="badge bg-label-<?php
                                                if ($lpj['status'] == 'Diproses') {
                                                    echo 'primary';
                                                } else if ($lpj['status'] == 'Diterima') {
                                                    echo 'danger';
                                                } else if ($lpj['status'] == 'Menunggu Persetujuan LPJ') {
                                                    echo 'warning';
                                                } else if ($lpj['status'] == 'Perlu Perbaikan') {
                                                    echo 'warning';
                                                } else if ($lpj['status'] == 'Selesai') {
                                                    echo 'success';
                                                } else {
                                                    echo 'danger';
                                                } ?> me-1"><?= ($lpj['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $lpj['status'] ?></span>
                                        </td>
                                        <td>
                                    </tr>
                                    <?php if ($lpj['status'] == 'Selesai'): ?>
                                        <tr>
                                            <td>Catatan</td>
                                            <td><?= $lpj['catatan'] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>

                                <div class="row">
                                    <div class="col mt-4">
                                        <div class="d-flex justify-content-end mt-4">
                                            <?php if ($user_login['role'] == 'Staf Unit'): ?>
                                                <a href="<?= base_url('lpj/edit/') . $lpj['id_kak'] ?>"
                                                    class="btn btn-sm btn-primary mx-2">
                                                    <i class="bx bx-pencil me-1"></i>
                                                    Edit LPJ
                                                </a>
                                                <a href="<?= base_url('lpj/hapus/') . $lpj['id_lpj'] ?>"
                                                    class="btn btn-sm btn-danger hapusbtn">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Hapus LPJ
                                                </a>
                                            <?php else: ?>
                                                <?php if ($lpj['status'] == 'Selesai'): ?>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter">Batal Validasi Lembar Pertanggung
                                                        Jawaban</button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter">Validasi Lembar Pertanggung
                                                        Jawaban</button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Validasi Lembar Pertanggung Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('lpj/validasi') ?>" method="post">
                        <input type="text" name="id_lpj" value="<?= $lpj['id_lpj'] ?>" hidden>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-0">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example" style="height: 55px" name="status" required>
                                        <option value="" selected>---Pilih Status---</option>
                                        <option value="Selesai" <?= ($lpj['status'] == 'Selesai') ? 'selected' : '' ?>>
                                            Selesai
                                        </option>
                                        <option value="Perlu Perbaikan" <?= ($lpj['status'] == 'Perlu Perbaikan') ? 'selected' : '' ?>>
                                            Perlu Perbaikan</option>
                                        <option value="Ditolak" <?= ($lpj['status'] == 'Ditolak') ? 'selected' : '' ?>>
                                            Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-0">
                                    <div class="form-floating my-3">
                                        <textarea name="catatan" id="catatan" class="form-control" id="floatingInput"
                                            placeholder="Catatan" aria-describedby="floatingInputHelp" name="catatan"
                                            required><?= $lpj['catatan'] ?></textarea>
                                        <label for="floatingInput">Catatan</label>
                                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="<?= base_url('assets') ?>/assets/js/hapusalert.js"></script>
        <?= $this->endSection() ?>