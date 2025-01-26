<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Detail Realisasi Kegiatan</h5>
    <div class="card-body">
        <form action="<?= base_url('laporan/detail-realisasi-kegiatan') ?>" method="get">
            <input type="hidden" name="unit" id="" value="<?= $unit_kerja ?>">
            <div class="row justify-content-end my-3">
                <div class="col">
                    <p>Unit Kerja: <?= $unit_kerja ?></p>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <select class="form-select me-2" name="bulan" id="bulan_kinerja" required>
                        <option value="">Pilih Bulan</option>
                        <?php
                        $bulan = [
                            'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        ];
                        foreach ($bulan as $key => $value): ?>
                            <option value="<?= $key + 1 ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-primary" id="cariButton">Cari</button>
                </div>
            </div>
        </form>
        <?php if (empty($kegiatan)): ?>
            <div class="alert alert-danger text-center my-3" role="alert">
                Data tidak ditemukan
            </div>
        <?php endif; ?>
        <div class="table-responsive text-nowrap">
            <?php foreach ($kegiatan as $key => $value): ?>
                <table class="table table-hover mb-4">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center">Kegiatan</th>
                            <th rowspan="2" class="align-middle text-center">Target</th>
                            <th colspan="9" class="text-center">Realisasi Kunjungan</th>
                        </tr>
                        <tr>
                            <th>Burujul Kulon</th>
                            <th>Burujul Wetan</th>
                            <th>Cicadas</th>
                            <th>Jatisura</th>
                            <th>Jatiwangi</th>
                            <th>Mekarsari</th>
                            <th>Surawangi</th>
                            <th>Sutawangi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $value['nama_kegiatan'] ?></td>
                            <td><?= $value['target'] ?></td>
                            <?php
                            $jumlah_kunjungan = explode(',', $value['jumlah_kunjungan']);
                            $total = 0;
                            foreach ($jumlah_kunjungan as $jumlah):
                                $total += (int) $jumlah;
                                ?>
                                <td><?= $jumlah ?></td>
                            <?php endforeach; ?>
                            <td><?= $total ?></td>
                        </tr>
                        <tr>
                            <th>Presentase</th>
                            <td>100%</td>
                            <?php
                            $jumlah_kunjungan = explode(',', $value['jumlah_kunjungan']);
                            $total = array_sum(array_map('intval', $jumlah_kunjungan));
                            foreach ($jumlah_kunjungan as $jumlah):
                                $percentage = ($total > 0) ? (intval($jumlah) / $total) * 100 : 0;
                                ?>
                                <td><?= number_format($percentage, 2) ?>%</td>
                            <?php endforeach; ?>
                            <?php
                            $target = intval($value['target']);
                            $overall_percentage = ($target > 0) ? ($total / $target) * 100 : 0;
                            ?>
                            <td><?= number_format($overall_percentage, 2) ?>%</td>
                        </tr>
                        <tr>
                            <th>Rasio Kegiatan</th>
                            <td colspan="10"><b><?= number_format($overall_percentage, 2) ?>%</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>