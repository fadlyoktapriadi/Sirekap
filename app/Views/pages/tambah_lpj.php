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

                <?php if ($kak['status'] == "Diterima" && $user_login['role'] != "Staf Unit"): ?>
                    <?php if (date('Y-m-D') <= date('Y-m-d', strtotime($kak['tanggal_mulai'] . ' -7 days'))): ?>
                        <div class="d-flex justify-content-end mx-4 my-3">
                            <a href="<?= base_url('lpj/batal/' . $kak['id_kak']) ?>">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter">Batal
                                    Validasi Kerangka Acuan Kerja</button>
                            </a>
                        </div>
                    <?php endif; ?>
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
                                <td><?= $kak['target'] ?> Kunjungan</td>
                            </tr>
                        </table>
                        <?php if ($kak['unit_kerja'] == $user_login['unit_kerja'] && $user_login['role'] == "Staf Unit"): ?>
                            <div class="row">
                                <div class="col">
                                    <h4 class="mt-4">Lembar Pertanggung Jawaban</h4>

                                    <form action="<?= base_url('lpj/simpan') ?>" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="id_kak" value="<?= $kak['id_kak'] ?>" />

                                        <div class="my-3">
                                            <label for="formFile" class="form-label">Jumlah Kunjungan di Desa</label>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Burujul Kulon</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="burujul_kulon" autofocus
                                                    required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Burujul Wetan</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="burujul_wetan" autofocus
                                                    required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Cicadas</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="cicadas" autofocus required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Jatisura</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="jatisura" autofocus required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Jatiwangi</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="jatiwangi" autofocus required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Mekarsari</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="mekarsari" autofocus required />
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Surawangi</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="surawangi" autofocus required />
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Sutawangi</span>
                                                <input type="number" class="form-control" placeholder="Jumlah kunjungan"
                                                    aria-describedby="basic-addon1" name="sutawangi" autofocus required />
                                            </div>
                                        </div>

                                        <label for="formFile" class="form-label">Rincian Pelaksanaan</label>
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" id="anggaran_digunakan"
                                                placeholder="Rp " aria-describedby="floatingInputHelp"
                                                name="anggaran_digunakan" />
                                            <label for="anggaran_digunakan">Anggaran Digunakan</label>
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
                                            <?php if ($user_login['role'] == "Staf Unit"): ?>
                                                <input type="submit" class="btn btn-success" value="Simpan" />
                                            <?php endif; ?>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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