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

                <div class="row mx-1">
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
                                <td><?= $lpj['target'] ?> Kunjungan</td>
                            </tr>

                        </table>

                        <div class="row">
                            <div class="col">
                                <h4 class="mt-4">Lembar Pertanggung Jawaban</h4>

                                <h6>Kunjungan di Desa</h6>
                                <div class="table-responsive mb-3">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nama Desa</th>
                                                <th>Burujul Kulon</th>
                                                <th>Burujul Wetan</th>
                                                <th>Cicadas</th>
                                                <th>Jatisura</th>
                                                <th>Jatiwangi</th>
                                                <th>Mekarsari</th>
                                                <th>Surawangi</th>
                                                <th>Sutawangi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jumlah Kunjungan</td>
                                                <?php
                                                foreach ($kunjungan as $index): ?>
                                                    <td><?= $index['jumlah_kunjungan'] ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr>
                                                <td>Total Kunjungan</td>
                                                <td colspan="8">
                                                    <?= array_sum(array_column($kunjungan, 'jumlah_kunjungan')) . " / " . $lpj['target'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hasil Capaian</td>
                                                <td colspan="8">
                                                    <b>
                                                        <?php
                                                        $total_kunjungan = array_sum(array_column($kunjungan, 'jumlah_kunjungan'));
                                                        $target = $lpj['target'];
                                                        $hasil = ($total_kunjungan / $target) * 100;
                                                        echo number_format($hasil, 2) . '%';
                                                        ?>
                                                    </b>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <table class="table">
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
                                                } else if ($lpj['status'] == 'Perlu Perbaikan LPJ') {
                                                    echo 'warning';
                                                } else if ($lpj['status'] == 'Selesai') {
                                                    echo 'success';
                                                } else {
                                                    echo 'danger';
                                                } ?> me-1"><?= ($lpj['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $lpj['status'] ?></span>
                                        </td>
                                        <td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td><?= $lpj['catatan'] ?></td>
                                    </tr>
                                </table>

                                <div class="row">
                                    <div class="col mt-4">
                                        <div class="d-flex justify-content-end mt-4">
                                            <?php if ($user_login['role'] == 'Staf Unit' && ($lpj['status'] == 'Menunggu Persetujuan LPJ' || $lpj['status'] == 'Perlu Perbaikan LPJ' || $lpj['status'] == 'LPJ Ditolak') && $lpj['unit_kerja'] == $user_login['unit_kerja']): ?>
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
                                                <?php if (($user_login['role'] != 'Staf Unit' && $user_login['unit_kerja'] == $lpj['unit_kerja']) || $user_login['role'] == 'Kepala Puskesmas'): ?>
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
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-4 my-2 pb-4">
                    <div class="col-md-6">
                        <h4 class="mt-2">Riwayat Kerangka Acuan Kerja</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Tanggal Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pengajuan KAK</td>
                                    <td><?= date('d F Y', strtotime($lpj['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <td>KAK Diterima</td>
                                    <td><?= date('d F Y', strtotime($lpj['tanggal_diterima'])) ?></td>
                                </tr>
                                <?php if ($lpj['status'] != "Diterima"): ?>
                                    <tr>
                                        <td>LPJ Diterima</td>
                                        <td><?= date('d F Y', strtotime($lpj['updated_at'])) ?></td>
                                    </tr>
                                    <?php if ($lpj['lpj_selesai'] != null): ?>
                                        <tr>
                                            <td>LPJ Selesai</td>
                                            <td><?= date('d F Y', strtotime($lpj['lpj_selesai'])) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </tbody>

                        </table>
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
                                        <option value="Perlu Perbaikan LPJ" <?= ($lpj['status'] == 'Perlu Perbaikan LPJ') ? 'selected' : '' ?>>
                                            Perlu Perbaikan LPJ</option>
                                        <option value="LPJ Ditolak" <?= ($lpj['status'] == 'LPJ Ditolak') ? 'selected' : '' ?>>
                                            LPJ Ditolak</option>
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