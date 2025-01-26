<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Realisasi Kegiatan</h5>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <form action="<?= base_url("laporan/detail-realisasi-kegiatan") ?>" method="get">
                <div class="my-3">
                    <label for="Program Kerja">Unit Kerja</label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                        style="height: 55px" name="unit" autofocus>
                        <option selected>--Pilih Unit kerja--</option>
                        <option value="Esensial dan Keperawatan Kesehatan Masyarakat">Esensial dan Keperawatan Kesehatan
                            Masyarakat</option>
                        <option value="Pengembangan">Pengembangan</option>
                        <option value="Kefarmasian & Laboratorium">Kefarmasian & Laboratorium</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end mb-4">
                    <button class="btn btn-primary">Kirim</button>
                </div>

            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>