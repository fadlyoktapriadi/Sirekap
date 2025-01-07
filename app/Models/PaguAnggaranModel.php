<?php

namespace App\Models;

use CodeIgniter\Model;

class PaguAnggaranModel extends Model
{
    protected $table = 'tbl_pagu_anggaran';
    protected $primaryKey = 'id_pagu_anggaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['jumlah_anggaran', 'tahun_anggaran'];

    public function getPaguAnggaran($tahun){
        return $this->where('tahun_anggaran', $tahun)
                    ->first();
    }
}

?>