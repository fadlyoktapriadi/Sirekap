<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatAnggaranModel extends Model
{
    protected $table = 'tbl_riwayat_anggaran';
    protected $primaryKey = 'id_riwayat_anggaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'jumlah_anggaran', 'label_anggaran'];

}

?>