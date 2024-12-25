<?php

namespace App\Models;

use CodeIgniter\Model;

class KerangkaKerjaModel extends Model
{
    protected $table = 'tbl_kerangka_kerja';
    protected $primaryKey = 'id_kak';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_proker', 'nama_kegiatan', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'anggaran_dibutuhkan', 'anggaran_disetujui', 'penanggung_jawab', 'sasaran', 'target', 'file', 'status',];

    public function getKerjangkaKerjaWithUsers()
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_karyawan.NIP, tbl_karyawan.nama_karyawan')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->findAll();
    }

    public function getKerjangkaKerjaById($id)
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_proker.*')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->join('tbl_proker', 'tbl_proker.id_proker = tbl_kerangka_kerja.id_proker')
            ->where('id_kak', $id)
            ->first();
    }

    public function getKerjangkaKerjaLpj()
    {
        return $this->select('tbl_kerangka_kerja.id_kak, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai,tbl_kerangka_kerja.tanggal_selesai, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.status')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('status', "Diterima")
            ->orWhere("status", "Menunggu Persetujuan LPJ")
            ->orWhere("status", "Perlu Perbaikan")
            ->findAll();
    }

    public function getRiwayatLpj()
    {
        return $this->select('tbl_kerangka_kerja.id_kak, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai,tbl_kerangka_kerja.tanggal_selesai, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.status')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('status', "Selesai")
            ->findAll();
    }
}

?>