<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h3 class="text-center mt-3">Detail Kerangka Acuan Kerja</h3>

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

    <div class="row mx-4">
        <div class="col-md-12">
            <h4 class="mt-2">Kegiatan</h4>
            <table class="table">
                <tr>
                    <td>Nama Program Kerja</td>
                    <td><?= $kak['program_kerja'] ?></td>
                </tr>
                <tr>
                    <td>Nama Kegiatan</td>
                    <td><?= $kak['nama_kegiatan'] ?></td>
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
                    <td>Unit Kerja</td>
                    <td><?= $kak['unit_kerja'] ?></td>
                </tr>
                <tr>
                    <td>Sasaran</td>
                    <td><?= $kak['sasaran'] ?></td>
                </tr>
                <tr>
                    <td>Target</td>
                    <td><?= $kak['target'] ?> Kunjungan</td>
                </tr>
                <tr>
                    <td>File Kerangka Acuan Kerja (KAK)</td>
                    <td><a href="<?= base_url('doc/kak/') . $kak['file'] ?>" target="_blank"><?= $kak['file'] ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><span
                            class="badge bg-label-<?php
                            if ($kak['status'] == 'Diproses') {
                                echo 'primary';
                            } else if ($kak['status'] == 'Diterima') {
                                echo 'danger';
                            } else if ($kak['status'] == 'Perlu Perbaikan KAK') {
                                echo 'warning';
                            } else if ($kak['status'] == 'Selesai') {
                                echo 'success';
                            } else {
                                echo 'danger';
                            } ?> me-1"><?= ($kak['status'] == 'Diterima') ? 'Belum Mengisi LPJ' : $kak['status'] ?></span>
                    </td>
                </tr>
                <?php if ($kak['status'] == 'Perlu Perbaikan KAK' || $kak['status'] == 'Ditolak'): ?>
                    <tr>
                        <td>Catatan Status</td>
                        <td><?= $kak['catatan_status'] ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php if (($user_login['role'] != 'Staf Unit' && $user_login['unit_kerja'] == $kak['unit_kerja']) || $user_login['role'] == 'Kepala Puskesmas'): ?>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-end mt-3 mx-4">
                    <?php if ($kak['status'] == 'Diterima'): ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter">Batal Validasi
                            Kerangka Acuan Kerja</button>
                    <?php elseif ($kak['status'] == 'Selesai'): ?>
                    <?php else: ?>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">Validasi Kerangka
                            Acuan Kerja</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mx-4 my-4">
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
                        <td><?= date('d F Y', strtotime($kak['created_at'])) ?></td>
                    </tr>
                    <?php if ($kak['status'] == 'Diterima'): ?>
                        <tr>
                            <td>KAK Diterima</td>
                            <td><?= date('d F Y', strtotime($kak['tanggal_diterima'])) ?></td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>
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
                    <input type="text" name="anggaran_lama" value="<?= $kak['anggaran_disetujui'] ?>" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-0">
                                <select class="form-select" id="status" aria-label="Default select example"
                                    style="height: 55px" name="status">
                                    <option value="Diproses" <?= ($kak['status'] == 'Diproses') ? 'selected' : '' ?>>
                                        Diproses</option>
                                    <option value="Diterima" <?= ($kak['status'] == 'Diterima') ? 'selected' : '' ?>>
                                        Diterima</option>
                                    <option value="Perlu Perbaikan KAK" <?= ($kak['status'] == 'Perlu Perbaikan KAK') ? 'selected' : '' ?>>
                                        Perlu Perbaikan KAK</option>
                                    <option value="KAK Ditolak" <?= ($kak['status'] == 'KAK Ditolak') ? 'selected' : '' ?>>
                                        KAK Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="dibutuhkan_form">
                            <div class="col mb-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="anggaran_dibutuhkan" placeholder="Rp "
                                        aria-describedby="floatingInputHelp" name="anggaran_dibutuhkan"
                                        value="Rp<?= number_format($kak['anggaran_dibutuhkan'], 0, ',', '.') ?>"
                                        disabled />
                                    <label for="anggaran_dibutuhkan">Anggaran Dibutuhkan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="anggaran_form">
                            <div class="col mb-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="anggaran_disetujui" placeholder="Rp "
                                        aria-describedby="floatingInputHelp" name="anggaran_disetujui"
                                        value="<?= $kak['anggaran_disetujui'] ?>" />
                                    <label for="anggaran_disetujui">Anggaran Disetujui</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="catatan_form">
                            <div class="col mb-0">
                                <div class="form-floating my-3">
                                    <textarea class="form-control" id="floatingInput" placeholder="Catatan"
                                        aria-describedby="floatingInputHelp"
                                        name="catatan_status"><?= $kak['catatan_status'] ?></textarea>
                                    <label for="floatingInput">Catatan Status</label>
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
</div>
<script>
    document.getElementById('anggaran_disetujui').addEventListener('input', function (e) {
        var value = e.target.value;
        value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        if (value) {
            value = parseInt(value, 10);
            e.target.value = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0
            }).format(value);
        } else {
            e.target.value = '';
        }
    });

    document.getElementById('status').addEventListener('change', function (e) {
        var catatan = document.getElementById('catatan_form');
        var anggaran = document.getElementById('anggaran_form');
        var dibutuhkan = document.getElementById('dibutuhkan_form');
        if (e.target.value === 'Perlu Perbaikan KAK' || e.target.value === 'Ditolak') {
            catatan.style.display = 'block';
            anggaran.style.display = 'none';
            dibutuhkan.style.display = 'none';
        } else if (e.target.value === 'Diterima') {
            anggaran.style.display = 'block';
            dibutuhkan.style.display = 'block';
            catatan.style.display = 'none';
        }
        else {
            catatan.style.display = 'none';
            anggaran.style.display = 'none';
            dibutuhkan.style.display = 'none';
        }
    });

    // Trigger change event on page load to handle pre-selected status
    document.getElementById('status').dispatchEvent(new Event('change'));
</script>

<?= $this->endSection() ?>