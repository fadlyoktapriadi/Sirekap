<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'tbl_karyawan';
    protected $primaryKey = 'NIP';
    protected $useTimestamps = true;
    protected $allowedFields = ['NIP', 'nama_karyawan', 'alamat', 'unit_kerja', 'jabatan'];

    public function getKaryawan(){
        return $this->where('jabatan !=', 'admin')
                    ->where('jabatan !=', 'kepala puskesmas')
                    ->orderBy('jabatan', 'ASC')
                    ->findAll();
    }
}

?>