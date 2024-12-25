<?php

namespace App\Models;

use CodeIgniter\Model;

class LpjModel extends Model
{
    protected $table = 'tbl_lpj';
    protected $primaryKey = 'id_lpj';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'capaian_pelaksanaan', 'anggaran_digunakan', 'keterangan', 'catatan', 'file_lpj', 'dokumentasi'];

    public function getLpjById($id)
    {
        return $this->select('tbl_lpj.*, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai, tbl_kerangka_kerja.tanggal_selesai, tbl_kerangka_kerja.anggaran_disetujui, tbl_kerangka_kerja.sasaran, tbl_kerangka_kerja.target, tbl_kerangka_kerja.status')
            ->join('tbl_kerangka_kerja', 'tbl_lpj.id_kak = tbl_kerangka_kerja.id_kak')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('tbl_lpj.id_kak', $id)
            ->first();
    }
}

?>