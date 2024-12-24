<?php

namespace App\Models;

use CodeIgniter\Model;

class LpjModel extends Model
{
    protected $table = 'tbl_lpj';
    protected $primaryKey = 'id_lpj';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'capaian_pelaksanaan', 'anggaran_digunakan', 'keterangan', 'catatan', 'file_lpj', 'dokumentasi'];

}

?>