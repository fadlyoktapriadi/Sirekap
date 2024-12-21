<?php

namespace App\Controllers;

class KerangkaKerja extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Data Kerangka Acuan Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Kerangka Acuan Kerja'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaWithUsers(),
        ];

        return view('pages/kerangkakerja', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kerangka Acuan Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Kerangka Acuan Kerja', 'Tambah Kerangka Acuan Kerja'],
            'proker' => $this->ProkerModel->findAll(),
            'penanggung_jawab' => $this->PenggunaModel->usersWithoutAdmin(),
        ];

        return view('pages/tambah_kak', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('file_kak');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('doc/', $newName);
            $fileKak = $newName;
        }

        $this->KerangkaKerjaModel->insert([
            'id_proker' => $this->request->getVar('id_proker'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'lokasi' => $this->request->getVar('lokasi'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'anggaran_dibutuhkan' => $this->request->getVar('anggaran_dibutuhkan'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'file' => $fileKak,
            'status' => "Diproses",
        ]);
        session()->setFlashdata('success', 'Data Kerangka Acuan Kerja berhasil disimpan!');

        return redirect()->to('/kak');
    }
}
