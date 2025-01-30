<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h3 class="card-header text-center mt-3">Profile</h3>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible text-center mx-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

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
                <form action="<?= base_url('/profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <input type="hidden" name="NIP" value="<?= $user['NIP'] ?>">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="NIP"
                            aria-describedby="floatingInputHelp" name="nip" value="<?= $user['NIP'] ?>" required
                            disabled />
                        <label for="floatingInput">NIP</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Nama"
                            aria-describedby="floatingInputHelp" name="nama_karyawan"
                            value="<?= $user['nama_karyawan'] ?>" required />
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating my-3">
                        <textarea name="alamat" class="form-control" id="floatingInput" placeholder="Alamat"
                            aria-describedby="floatingInputHelp" id="alamat"><?= $user['alamat'] ?></textarea>
                        <label for="floatingInput">Alamat</label>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Unit Kerja"
                                    aria-describedby="floatingInputHelp" name="unit_kerja"
                                    value="<?= $user['unit_kerja'] ?>" required disabled />
                                <label for="floatingInput">Unit Kerja</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Jabatan"
                                    aria-describedby="floatingInputHelp" name="jabatan" value="<?= $user['jabatan'] ?>"
                                    required disabled />
                                <label for="floatingInput">Jabatan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                            aria-describedby="floatingInputHelp" name="username" value="<?= $user['username'] ?>"
                            required />
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                            aria-describedby="floatingInputHelp" name="password" />
                        <label for="floatingInput">Password</label>
                        <small>*Kosongkan jika tidak ingin mengganti password</small>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>