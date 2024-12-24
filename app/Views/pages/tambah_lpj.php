<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
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
                                <td><?= $kak['nama_kegiatan'] ?></td>
                            </tr>
                            <tr>
                                <td>Unit Kerja</td>
                                <td><?= $kak['unit_kerja'] ?></td>
                            </tr>
                            <tr>
                                <td>Pelaksanaan</td>
                                <td><?= date('d F Y', strtotime($kak['tanggal_mulai'])) ?> s/d
                                    <?= date('d F Y', strtotime($kak['tanggal_selesai'])) ?>
                                </td>
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

                        </table>

                        <div class="row">
                            <div class="col">
                                <h4 class="mt-4">Lembar Pertanggung Jawaban</h4>

                                <form action="<?= base_url('lpj/simpan') ?>" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="id_kak" value="<?= $kak['id_kak'] ?>" />
                                    <div class="form-floating my-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="Jumlah pasien yang ditangani"
                                            aria-describedby="floatingInputHelp" name="capaian_pelaksanaan" autofocus
                                            required />
                                        <label for="floatingInput">Capaian Pelaksanaan</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="Rp."
                                            aria-describedby="floatingInputHelp" name="anggaran_digunakan" required />
                                        <label for="floatingInput">Anggaran yang digunakan</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <textarea name="keterangan" id="keterangan" class="form-control"
                                            id="floatingInput" placeholder="Keterangan Kegiatan"
                                            aria-describedby="floatingInputHelp" name="keterangan" required></textarea>
                                        <label for="floatingInput">Keterangan Kegiatan</label>
                                    </div>
                                    <div class="my-3">
                                        <label for="formFile" class="form-label">Dokumen Lembar Pertanggung
                                            Jawaban</label>
                                        <input class="form-control" type="file" name="file_lpj" id="formFile">
                                    </div>
                                    <div class="my-3">
                                        <label for="formFile" class="form-label">Dokumentasi Kegiatan</label>
                                        <input class="form-control" type="file" name="dokumentasi" id="formFile">
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-success" value="Simpan" />
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->endSection() ?>