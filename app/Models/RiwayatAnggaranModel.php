<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatAnggaranModel extends Model
{
    protected $table = 'tbl_riwayat_anggaran';
    protected $primaryKey = 'id_riwayat_anggaran';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kak', 'jumlah_anggaran', 'label_anggaran'];

    public function getRiwayatAnggaran($id)
    {
        return $this->where('id_kak', $id)
            ->where('label_anggaran', 'Keluar')
            ->first();
    }

    public function updateRiwayatAnggaran($id, $anggaran)
    {
        return $this->where('id_kak', $id)
            ->where('label_anggaran', 'Keluar')
            ->set('jumlah_anggaran', $anggaran)
            ->update();
    }
}

?>