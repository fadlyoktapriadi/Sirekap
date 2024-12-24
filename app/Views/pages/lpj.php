<?= $this->extend('templates/navbar_template') ?>

<?= $this->section('content') ?>

<!-- Basic Bootstrap Table -->
<div class="card">
    <h5 class="card-header">Data Lembar Pertanggung Jawaban</h5>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible text-center mx-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible text-center mx-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive text-nowrap mt-4 mx-4">

        <table id="dataTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Unit Kerja</th>
                    <th>Pelaksanaan</th>
                    <th>Penanggung Jawab</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                foreach ($kak as $item): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item['nama_kegiatan'] ?></td>
                        <td><?= $item['unit_kerja'] ?></td>
                        <td><?= date('d F Y', strtotime($item['tanggal_mulai'])) ?> s/d <?= date('d F Y', strtotime($item['tanggal_selesai'])) ?></td>
                        <td><?= $item['nama_karyawan'] ?></td>
                        <td><span class="badge bg-label-danger me-1">Belum LPJ</span></td>
                        <td>
                            <a href="<?= base_url('lpj/tambah/') . $item['id_kak'] ?>">
                                <button class="btn btn-sm btn-info">Input LPJ</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets') ?>/assets/js/hapusalert.js"></script>
<?= $this->endSection() ?>