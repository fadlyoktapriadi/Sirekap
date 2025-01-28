<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['NIP', 'username', 'password', 'role'];

    public function getUsersKaryawan()
    {
        return $this->db->table($this->table)
            ->select('tbl_users.*, tbl_karyawan.*')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_users.NIP')
            ->orderBy('jabatan', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getUserKaryawan($nik)
    {
        return $this->db->table($this->table)
            ->select('tbl_users.username, tbl_users.role, tbl_karyawan.nama_karyawan, tbl_karyawan.unit_kerja')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_users.NIP')
            ->where('tbl_users.NIP', $nik)
            ->get()
            ->getRowArray();
    }

    public function getUserKaryawanById($id)
    {
        return $this->db->table($this->table)
            ->select('tbl_users.*, tbl_karyawan.*')
            ->join('tbl_karyawan', 'tbl_karyawan.NIP = tbl_users.NIP')
            ->where('tbl_users.id_user  ', $id)
            ->get()
            ->getRowArray();
    }

    public function deleteUserKaryawan($id)
    {
        // Get the NIP of the user to be deleted
        $user = $this->db->table($this->table)
            ->select('NIP')
            ->where('id_user', $id)
            ->get()
            ->getRowArray();

        if ($user) {
            $nip = $user['NIP'];

            // Start a transaction
            $this->db->transStart();

            // Delete the user from tbl_users
            $this->db->table($this->table)
                ->where('id_user', $id)
                ->delete();

            // Delete the corresponding karyawan from tbl_karyawan
            $this->db->table('tbl_karyawan')
                ->where('NIP', $nip)
                ->delete();

            // Complete the transaction
            $this->db->transComplete();

            // Check if the transaction was successful
            if ($this->db->transStatus() === FALSE) {
                // If the transaction failed, rollback and return false
                $this->db->transRollback();
                return false;
            } else {
                // If the transaction was successful, commit and return true
                $this->db->transCommit();
                return true;
            }
        }

        return false;
    }
}

?>