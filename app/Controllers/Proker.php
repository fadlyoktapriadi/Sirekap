<?php

namespace App\Controllers;

class Proker extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Data Program Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Program Kerja'],
            'proker' => $this->ProkerModel->findAll()
        ];

        return view('pages/proker', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Program Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Program Kerja', 'Tambah Program Kerja'],
        ];

        return view('pages/tambah_proker', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_proker' => 'required',
            'deskripsi' => 'required',
            'tujuan' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data = [
            'nama_proker' => $this->request->getVar('nama_proker'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tujuan' => $this->request->getVar('tujuan'),
        ];

        $this->ProkerModel->insert($data);

        return redirect()->to('/proker')->with('success', 'Data Program Kerja berhasil disimpan');

    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Program Kerja', 'Edit Program Kerja'],
            'proker' => $this->ProkerModel->find($id)
        ];

        return view('pages/edit_proker', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_proker');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_proker' => 'required',
            'deskripsi' => 'required',
            'tujuan' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $data = [
            'nama_proker' => $this->request->getVar('nama_proker'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tujuan' => $this->request->getVar('tujuan'),
        ];

        $this->ProkerModel->update($id, $data);

        return redirect()->to('/proker')->with('success', 'Data Program Kerja berhasil diubah');
    }

    public function delete($id)
    {
        $this->ProkerModel->delete($id);
        return redirect()->to('/proker')->with('success', 'Data Program Kerja berhasil dihapus');
    }

}
