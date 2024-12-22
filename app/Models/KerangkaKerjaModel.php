<?php

namespace App\Models;

use CodeIgniter\Model;

class KerangkaKerjaModel extends Model
{
    protected $table = 'tbl_kerangka_kerja';
    protected $primaryKey = 'id_kak';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_proker', 'nama_kegiatan', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'anggaran_dibutuhkan', 'anggaran_disetujui', 'penanggung_jawab', 'file', 'status',];

    public function getKerjangkaKerjaWithUsers()
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_pengguna.nip, tbl_pengguna.nama_pengguna')
            ->join('tbl_pengguna', 'tbl_pengguna.nip = tbl_kerangka_kerja.penanggung_jawab')
            ->findAll();
    }

    public function getKerjangkaKerjaWithUserById($id)
    {
        return $this->select('tbl_kerangka_kerja.*, tbl_pengguna.nip, tbl_pengguna.nama_pengguna')
            ->join('tbl_pengguna', 'tbl_pengguna.nip = tbl_kerangka_kerja.penanggung_jawab')
            ->where('id_kak', $id)
            ->find();
    }
}

?>