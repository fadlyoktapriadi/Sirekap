<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-4">
                <h5 class="card-header">Tambah Program Kerja</h5>
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
                    <form action="<?= base_url('/proker/update') ?>" method="post">
                        <input type="hidden" name="id_proker" value="<?= $proker['id_proker'] ?>">
                        <?= csrf_field() ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Program Kerja"
                                aria-describedby="floatingInputHelp" name="nama_proker"
                                value="<?= $proker['nama_proker'] ?>" autofocus required />
                            <label for="floatingInput">Nama Program Kerja</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea name="deskripsi" id="deskripsi" class="form-control" id="floatingInput"
                                placeholder="Deskripsi program kerja.." aria-describedby="floatingInputHelp"
                                name="deskripsi" required><?= $proker['deskripsi'] ?></textarea>
                            <label for="floatingInput">Deskripsi</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Tujuan"
                                aria-describedby="floatingInputHelp" name="tujuan" value="<?= $proker['tujuan'] ?>"
                                required />
                            <label for="floatingInput">Tujuan</label>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>