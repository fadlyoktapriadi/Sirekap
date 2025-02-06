<?php

namespace App\Models;

use CodeIgniter\Model;

class LpjModel extends Model
{
    protected $table = 'tbl_lpj';
    protected $primaryKey = 'id_lpj';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'anggaran_digunakan', 'keterangan', 'catatan', 'file_lpj', 'dokumentasi', 'lpj_selesai', 'tanggal_selesai'];

    public function getLpjById($id)
    {
        return $this->select('tbl_lpj.*, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai, tbl_kerangka_kerja.tanggal_selesai, tbl_kerangka_kerja.anggaran_disetujui, tbl_kerangka_kerja.sasaran, tbl_kerangka_kerja.target, tbl_kerangka_kerja.status, tbl_kerangka_kerja.tanggal_diterima, tbl_kerangka_kerja.created_at', )
            ->join('tbl_kerangka_kerja', 'tbl_lpj.id_kak = tbl_kerangka_kerja.id_kak')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('tbl_lpj.id_kak', $id)
            ->first();
    }

    public function jumlahAnggaranDigunakan()
    {
        return $this->selectSum('anggaran_digunakan')
            ->join('tbl_kerangka_kerja', 'tbl_lpj.id_kak = tbl_kerangka_kerja.id_kak')
            ->where('tbl_kerangka_kerja.status', 'Selesai')
            ->first();
    }
}

?>