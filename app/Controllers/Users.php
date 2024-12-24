<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {

        $data = [
            'title' => 'Data Pengguna',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Pengguna'],
            'users' => $this->UsersModel->getUsersKaryawan()
        ];

        return view('pages/users', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Pengguna', 'Tambah Pengguna'],
        ];

        return view('pages/tambah_user', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_karyawan' => 'required',
            'NIP' => 'required|is_unique[tbl_users.NIP]|min_length[18]',
            'alamat' => 'required',
            'username' => 'required|is_unique[tbl_users.username]|min_length[5]',
            'password' => 'required|min_length[5]',
            'role' => 'required',
            'unit_kerja' => 'required',
            'jabatan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data_user = [
            'NIP' => $this->request->getVar('NIP'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
        ];

        $data_karyawan = [
            'NIP' => $this->request->getVar('NIP'),
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'alamat' => $this->request->getVar('alamat'),
            'unit_kerja' => $this->request->getVar('unit_kerja'),
            'jabatan' => $this->request->getVar('jabatan')
        ];

        $this->UsersModel->insert($data_user);
        $this->KaryawanModel->insert($data_karyawan);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil disimpan');
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Pengguna',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Pengguna', 'Edit Pengguna'],
            'user' => $this->UsersModel->getUserKaryawanById($id)
        ];

        return view('pages/edit_user', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_user');
        $nik_lama = $this->request->getVar('nik_lama');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_karyawan' => 'required',
            'NIP' => 'required|min_length[18]',
            'alamat' => 'required',
            'username' => 'required|min_length[5]',
            'role' => 'required',
            'unit_kerja' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data_user = [
            'NIP' => $this->request->getVar('NIP'),
            'username' => $this->request->getVar('username'),
            'role' => $this->request->getVar('role'),
        ];

        $data_karyawan = [
            'NIP' => $this->request->getVar('NIP'),
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'alamat' => $this->request->getVar('alamat'),
            'unit_kerja' => $this->request->getVar('unit_kerja'),
            'jabatan' => $this->request->getVar('jabatan')
        ];

        if ($this->request->getVar('password')) {
            $data_user['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $this->UsersModel->update($id, $data_user);

        $this->KaryawanModel->update($nik_lama, $data_karyawan);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil diubah');

    }

    public function hapus($id)
    {
        $this->UsersModel->deleteUserKaryawan($id);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil dihapus');
    }

}
