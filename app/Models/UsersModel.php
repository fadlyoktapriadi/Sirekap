<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tbl_pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $useTimestamps = true;
    protected $allowedFields = ['NIP', 'nama_pengguna', 'alamat', 'unit_kerja', 'username', 'password', 'role'];

    public function usersWithoutAdmin()
    {
        return $this->where('role !=', 'administrator')->findAll();
    }
}

?>