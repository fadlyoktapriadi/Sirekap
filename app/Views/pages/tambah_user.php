<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-4">
                <h5 class="card-header">Tambah Pengguna</h5>
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
                    <form action="<?= base_url('/users/tambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Pengguna"
                                aria-describedby="floatingInputHelp" name="nama_karyawan" required />
                            <label for="floatingInput">Nama</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="NIP"
                                aria-describedby="floatingInputHelp" name="NIP" required />
                            <label for="floatingInput">NIP</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea name="alamat" id="alamat" class="form-control" id="floatingInput"
                                placeholder="Jl. Contoh No. 1" aria-describedby="floatingInputHelp" name="alamat"
                                required></textarea>
                            <label for="floatingInput">Alamat</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                                aria-describedby="floatingInputHelp" name="username" required />
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="password" class="form-control" id="floatingInput" placeholder="*****"
                                aria-describedby="floatingInputHelp" name="password" required />
                            <label for="floatingInput">Password</label>
                        </div>
                        <div class="my-3">
                            <select class="form-select" id="exampleFormControlSelect1"
                                aria-label="Default select example" style="height: 55px" name="role">
                                <option selected>--Pilih Role--</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Kepala Puskesmas">Kepala Puskesmas</option>
                                <option value="Kepala Unit">Kepala Unit</option>
                                <option value="Staf Unit">Staf Unit</option>
                            </select>
                        </div>
                        <div class="my-3">
                            <select class="form-select" id="exampleFormControlSelect1"
                                aria-label="Default select example" style="height: 55px" name="unit_kerja">
                                <option selected>--Pilih Unit Kerja--</option>
                                <option value="Esensial dan Keperawatan Kesehatan Masyarakat">Esensial dan Keperawatan
                                    Kesehatan Masyarakat</option>
                                <option value="Pengembangan">Pengembangan</option>
                                <option value="Kefarmasian & Laboratorium">Kefarmasian & Laboratorium</option>
                            </select>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Jabatan"
                                aria-describedby="floatingInputHelp" name="jabatan" required />
                            <label for="floatingInput">Jabatan</label>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>