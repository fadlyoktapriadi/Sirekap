<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $table = 'tbl_kunjungan';
    protected $primaryKey = 'id_kunjungan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'nama_desa', 'jumlah_kunjungan'];

    public function getKunjunganById($id)
    {
        return $this->where('id_kak', $id)
            ->orderBy('nama_desa', 'ASC')
            ->findAll();
    }
}

?>