<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'User Management',
            'breadcrumb' => ['User Management'],
            'users' => $this->PenggunaModel->findAll()
        ];

        return view('pages/user_management', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah User',
            'breadcrumb' => ['User Management', 'Tambah User'],
        ];

        return view('pages/tambah_user', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pengguna' => 'required',
            'NIP' => 'required|is_unique[tbl_pengguna.NIP]|min_length[18]',
            'alamat' => 'required',
            'username' => 'required|is_unique[tbl_pengguna.username]|min_length[5]',
            'password' => 'required|min_length[5]',
            'role' => 'required',
            'unit_kerja' => 'required'   
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data = [
            'nama_pengguna' => $this->request->getVar('nama_pengguna'),
            'NIP' => $this->request->getVar('NIP'),
            'alamat' => $this->request->getVar('alamat'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
            'unit_kerja' => $this->request->getVar('unit_kerja')
        ];

        $this->PenggunaModel->insert($data);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil disimpan');
    }

    public function cari()
    {
        $keyword = $this->request->getVar('keyword');

        $data = [
            'title' => 'User Management',
            'breadcrumb' => ['User Management'],
            'users' => $this->PenggunaModel->like('nama_pengguna', $keyword)->findAll()
        ];

        return view('pages/user_management', $data);
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit User',
            'breadcrumb' => ['User Management', 'Edit User'],
            'user' => $this->PenggunaModel->find($id)
        ];

        return view('pages/edit_user', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_pengguna');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_pengguna' => 'required',
            'NIP' => 'required|min_length[18]',
            'alamat' => 'required',
            'username' => 'required|min_length[5]',
            'role' => 'required',
            'unit_kerja' => 'required'   
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data = [
            'nama_pengguna' => $this->request->getVar('nama_pengguna'),
            'NIP' => $this->request->getVar('NIP'),
            'alamat' => $this->request->getVar('alamat'),
            'username' => $this->request->getVar('username'),
            'role' => $this->request->getVar('role'),
            'unit_kerja' => $this->request->getVar('unit_kerja')
        ];

        if ($this->request->getVar('password')) {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $this->PenggunaModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil diubah');
        
    }

    public function hapus($id)
    {
        $this->PenggunaModel->delete($id);

        return redirect()->to('/users')->with('success', 'Data pengguna berhasil dihapus');
    }
}
