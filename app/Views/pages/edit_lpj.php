<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <h3 class="card-header text-center mt-3">Pengisian Lembar Pertanggung Jawaban</h3>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible text-center mx-4">
                        <?= session()->getFlashdata('error') ?>
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
                                <td><?= $lpj['target'] ?> Kunjungan</td>
                            </tr>

                        </table>

                        <div class="row">
                            <div class="col">
                                <h4 class="mt-4">Lembar Pertanggung Jawaban</h4>

                                <form action="<?= base_url('lpj/update') ?>" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="id_lpj" value="<?= $lpj['id_lpj'] ?>">
                                    <input type="hidden" name="id_kak" value="<?= $lpj['id_kak'] ?>">
                                    <input type="hidden" name="lpj_lama" value="<?= $lpj['file_lpj'] ?>">
                                    <input type="hidden" name="dokumentasi_lama" value="<?= $lpj['dokumentasi'] ?>">

                                    <div class="my-3">
                                        <label for="formFile" class="form-label">Jumlah Kunjungan di Desa</label>
                                        <?php foreach ($kunjungan as $k): ?>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><?= $k['nama_desa'] ?></span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="<?= strtolower(str_replace(' ', '_', $k['nama_desa'])) ?>" value="<?= $k['jumlah_kunjungan'] ?>"
                                                    required />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <label for="formFile" class="form-label">Rincian Pelaksanaan</label>

                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="anggaran_digunakan"
                                            placeholder="Rp " aria-describedby="floatingInputHelp"
                                            name="anggaran_digunakan" value="<?= $lpj['anggaran_digunakan'] ?>"/>
                                        <label for="anggaran_digunakan">Anggaran Digunakan</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <textarea name="keterangan" id="keterangan" class="form-control"
                                            id="floatingInput" placeholder="Keterangan Kegiatan"
                                            aria-describedby="floatingInputHelp" name="keterangan"
                                            required><?= $lpj['keterangan'] ?></textarea>
                                        <label for="floatingInput">Keterangan Kegiatan</label>
                                    </div>
                                    <div class="my-3">
                                        <label for="formFile" class="form-label">Dokumen Lembar Pertanggung
                                            Jawaban</label>
                                        <input class="form-control" type="file" name="file_lpj" id="formFile">
                                        <small>*Kosongkan jika tidak ingin mengganti dokumen sebelumnya</small>
                                    </div>
                                    <div class="my-3">
                                        <label for="formFile" class="form-label">Dokumentasi Kegiatan</label>
                                        <input class="form-control" type="file" name="dokumentasi" id="formFile">
                                        <small>*Kosongkan jika tidak ingin mengganti dokumen sebelumnya</small>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary" value="Simpan" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('anggaran_digunakan').addEventListener('input', function (e) {
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
        </script>
        <?= $this->endSection() ?>