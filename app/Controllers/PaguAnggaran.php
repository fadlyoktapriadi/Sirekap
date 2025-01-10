<?php

namespace App\Controllers;

class PaguAnggaran extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'title' => 'Pagu Anggaran',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Pagu Anggaran'],
            'pagu' => $this->PaguAnggaranModel->findAll(),
        ];

        return view('pages/paguanggaran', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Pagu Anggaran',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Pagu Anggaran', 'Tambah Pagu Anggaran'],
        ];

        return view('pages/tambah_pagu_anggaran', $data);
    }

    public function simpan()
    {
        $check = $this->PaguAnggaranModel->getPaguAnggaran($this->request->getVar('tahun_anggaran'));

        if (!empty($check)) {
            session()->setFlashdata('error', 'Pagu Tahun anggaran sudah ada.');
            return redirect()->back()->withInput();
        }

        $data = [
            'tahun_anggaran' => $this->request->getVar('tahun_anggaran'),
            'jumlah_anggaran' => intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('jumlah_anggaran'))))
        ];

        $this->PaguAnggaranModel->insert($data);

        $this->session->setFlashdata('success', 'Pagu Anggaran berhasil ditambahkan.');
        return redirect()->to(uri: '/pagu-anggaran');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Pagu Anggaran',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Pagu Anggaran', 'Edit Pagu Anggaran'],
            'pagu' => $this->PaguAnggaranModel->find($id)
        ];

        return view('pages/edit_pagu_anggaran', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_pagu_anggaran');

        $check = $this->PaguAnggaranModel->where('tahun_anggaran', $this->request->getVar('tahun_anggaran'))
            ->where('id_pagu_anggaran !=', $id)
            ->first();

        if (!empty($check)) {
            session()->setFlashdata('error', 'Pagu Tahun anggaran sudah ada.');
            return redirect()->back()->withInput();
        }

        $data = [
            'tahun_anggaran' => $this->request->getVar('tahun_anggaran'),
            'jumlah_anggaran' => intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('jumlah_anggaran'))))
        ];

        $this->PaguAnggaranModel->update($id, $data);

        $this->session->setFlashdata('success', 'Pagu Anggaran berhasil diupdate.');
        return redirect()->to('/pagu-anggaran');
    }

    public function hapus($id)
    {
        $this->PaguAnggaranModel->delete($id);

        return redirect()->to('/pagu-anggaran')->with('success', 'Data pengguna berhasil dihapus');
    }
}