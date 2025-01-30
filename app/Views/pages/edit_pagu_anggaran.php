<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Pagu Anggaran</h5>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible text-center mx-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="<?= base_url('/pagu-anggaran/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_pagu_anggaran" value="<?= $pagu['id_pagu_anggaran'] ?>" />
                        <div class="form-floating my-3">
                            <input type="number" class="form-control" id="floatingInput" placeholder="Tahun Anggaran"
                                aria-describedby="floatingInputHelp" name="tahun_anggaran"
                                value="<?= $pagu['tahun_anggaran'] ?>" required />
                            <label for="floatingInput">Tahun Anggaran</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="jumlah_anggaran" placeholder="Rp "
                                aria-describedby="floatingInputHelp" name="jumlah_anggaran"
                                value="<?= $pagu['jumlah_anggaran'] ?>" />
                            <label for="jumlah_anggaran">Jumlah Anggaran</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="balance" placeholder="Rp "
                                aria-describedby="floatingInputHelp" name="balance" value="<?= $pagu['balance'] ?>" />
                            <label for="balance">Balance</label>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('jumlah_anggaran').addEventListener('input', function (e) {
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
    document.getElementById('balance').addEventListener('input', function (e) {
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