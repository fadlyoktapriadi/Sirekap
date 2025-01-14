<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">Tambah Kerangka Acuan Kerja</h5>
                <div class="card-body">
                    <?php if ($validation = session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($validation as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible text-center">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('/kak/tambah') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Program Kerja"
                                aria-describedby="floatingInputHelp" name="program_kerja" required />
                            <label for="floatingInput">Program Kerja</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Kegiatan"
                                aria-describedby="floatingInputHelp" name="nama_kegiatan" required />
                            <label for="floatingInput">Nama Kegiatan</label>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="floatingInput"
                                        placeholder="Tanggal Mulai" aria-describedby="floatingInputHelp"
                                        name="tanggal_mulai" required />
                                    <label for="floatingInput">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="floatingInput"
                                        placeholder="Tanggal Selesai" aria-describedby="floatingInputHelp"
                                        name="tanggal_selesai" required />
                                    <label for="floatingInput">Tanggal Selesai</label>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <select class="form-select" id="exampleFormControlSelect1"
                                aria-label="Default select example" style="height: 55px" name="penanggung_jawab"
                                autofocus>
                                <option selected>--Pilih Penanggung Jawab--</option>
                                <?php foreach ($penanggung_jawab as $item): ?>
                                    <option value="<?= $item['NIP'] ?>"><?= $item['nama_karyawan'] ?>
                                        (<?= $item['unit_kerja'] ?> )
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row my-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Sasaran"
                                        aria-describedby="floatingInputHelp" name="sasaran" required />
                                    <label for="floatingInput">Sasaran</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="floatingInput"
                                        placeholder="Jumlah Kunjungan" aria-describedby="floatingInputHelp"
                                        name="target" required />
                                    <label for="floatingInput">Target</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="anggaran_dibutuhkan" placeholder="Rp "
                                aria-describedby="floatingInputHelp" name="anggaran_dibutuhkan" required />
                            <label for="anggaran_dibutuhkan">Anggaran Dibutuhkan</label>
                        </div>

                        <div class="my-3">
                            <label for="formFile" class="form-label">Dokumen Kerangka Acuan Kerja</label>
                            <input class="form-control" type="file" name="file_kak" id="formFile">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('anggaran_dibutuhkan').addEventListener('input', function (e) {
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