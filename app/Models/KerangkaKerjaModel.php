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
            ->where('status', "Diproses")
            ->orderBy("created_at", "asc")
            ->findAll();
    }

    public function getKerjangkaKerjaByFilter($filter)
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_karyawan.NIP, tbl_karyawan.nama_karyawan')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('tbl_karyawan.unit_kerja', $filter)
            ->where('status', "Diproses")
            ->orderBy("created_at", "asc")
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
            ->orderBy("tbl_kerangka_kerja.created_at", "asc")
            ->findAll();
    }

    public function getKerjangkaKerjaLpjWithFilter($unit)
    {
        return $this->select('tbl_kerangka_kerja.id_kak, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai,tbl_kerangka_kerja.tanggal_selesai, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.status')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('tbl_karyawan.unit_kerja', $unit)
            ->Where('status !=', "Diproses")
            ->Where('status !=', "Selesai")
            ->orderBy("tbl_kerangka_kerja.created_at", "asc")
            ->findAll();
    }

    public function getRiwayatLpj()
    {
        return $this->select('tbl_kerangka_kerja.id_kak, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai,tbl_kerangka_kerja.tanggal_selesai, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.status')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('status', "Selesai")
            ->findAll();
    }

    public function getRiwayatLpjWithFilter($unit)
    {
        return $this->select('tbl_kerangka_kerja.id_kak, tbl_kerangka_kerja.nama_kegiatan, tbl_kerangka_kerja.tanggal_mulai,tbl_kerangka_kerja.tanggal_selesai, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja, tbl_kerangka_kerja.status')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_kerangka_kerja.penanggung_jawab')
            ->where('tbl_karyawan.unit_kerja', $unit)
            ->where('status', "Selesai")
            ->orderBy("tbl_kerangka_kerja.created_at", "asc")
            ->findAll();
    }

    public function countKakSetuju()
    {
        return $this->where('status', "Diterima")
            ->orWhere('status', "Menunggu Persetujuan LPJ")
            ->orWhere('status', "Selesai")
            ->countAllResults();
    }

    public function countKakBerjalan()
    {
        return $this->Where('status !=', "Selesai")
            ->Where('status !=', "Ditolak")
            ->countAllResults();
    }

    public function statusKegiatan()
    {
        return $this->select('nama_kegiatan, status, created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->findAll();
    }

    public function jumlahAnggaranKegiatan()
    {
        return $this->selectSum('anggaran_disetujui')
            ->first();
    }

    public function getKerjangkaKerjaUnit($unit)
    {
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

    public function getKakSelesaiByMonth($year)
    {
        return $this->select("MONTH(tbl_lpj.lpj_selesai) AS bulan, COUNT(*) AS total_kak_selesai")
            ->join('tbl_lpj', 'tbl_kerangka_kerja.id_kak = tbl_lpj.id_kak')
            ->where("YEAR(tbl_lpj.lpj_selesai)", $year)
            ->where("tbl_kerangka_kerja.status", "Selesai")
            ->groupBy("MONTH(tbl_lpj.lpj_selesai)")
            ->findAll();
    }

    public function countKakSelesai()
    {
        return $this->Where('status', "Selesai")
            ->countAllResults();
    }
}

?>