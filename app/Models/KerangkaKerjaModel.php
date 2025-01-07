<?php

namespace App\Models;

use CodeIgniter\Model;

class KerangkaKerjaModel extends Model
{
    protected $table = 'tbl_kerangka_kerja';
    protected $primaryKey = 'id_kak';
    protected $useTimestamps = true;
    protected $allowedFields = ['program_kerja', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'anggaran_dibutuhkan', 'anggaran_disetujui', 'penanggung_jawab', 'sasaran', 'target', 'file', 'status', 'tanggal_diterima'];

    public function getKerjangkaKerjaWithUsers()
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_karyawan.NIP, tbl_karyawan.nama_karyawan')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->findAll();
    }

    public function getKerjangkaKerjaById($id)
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
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

    public function countKakSetuju(){
        return $this->where('status', "Diterima")
                    ->orWhere('status', "Menunggu Persetujuan LPJ")
                    ->orWhere('status', "Selesai")
                    ->countAllResults();
    }

    public function countKakBerjalan(){
        return $this->Where('status !=', "Selesai")
                    ->Where('status !=', "Ditolak")
                    ->countAllResults();
    }

    public function statusKegiatan(){
        return $this->select('nama_kegiatan, status, created_at')
                    ->findAll();
    }

    public function jumlahAnggaranKegiatan(){
        return $this->selectSum('anggaran_disetujui')
                ->first();
    }

    public function getKerjangkaKerjaUnit($unit){
        return $this->select('tbl_karyawan.unit_kerja, COUNT(tbl_kerangka_kerja.id_kak) as jumlah_kegiatan')
                    ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
                    ->where('tbl_karyawan.unit_kerja', $unit)
                    ->countAllResults();
    }

    public function getKakCountByMonth($year)
    {
        return $this->select("MONTH(created_at) AS bulan, COUNT(*) AS total_kak")
                ->where("YEAR(created_at)", $year)
                ->where("status", "Diproses")
                ->groupBy("MONTH(created_at)")
                ->findAll();
    }

    public function getLpjCountByMonth($year)
    {
        return $this->select("MONTH(created_at) AS bulan, COUNT(*) AS total_kak")
                ->where("YEAR(created_at)", $year)
                ->where("status", "Diterima")
                ->orWhere("status", "Menunggu Persetujuan LPJ")
                ->orWhere("status", "Perlu Perbaikan")
                ->groupBy("MONTH(created_at)")
                ->findAll();
    }

    public function getKakSelesaiByMonth($year)
    {
        return $this->select("MONTH(created_at) AS bulan, COUNT(*) AS total_kak_selesai")
                ->where("YEAR(created_at)", $year)
                ->where("status", "Selesai")
                ->groupBy("MONTH(created_at)")
                ->findAll();
    }

    public function countKakSelesai(){
        return $this->Where('status', "Selesai")
                    ->countAllResults();
    }
}

?>