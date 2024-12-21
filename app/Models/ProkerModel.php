<?php 

    namespace App\Models;

    use CodeIgniter\Model;

    class ProkerModel extends Model
    {
        protected $table = 'tbl_proker';
        protected $primaryKey = 'id_proker';
        protected $useTimestamps = true;
        protected $allowedFields = ['nama_proker', 'deskripsi', 'tujuan'];
    }

?>