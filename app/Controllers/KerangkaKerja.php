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
            'penanggung_jawab' => $this->KaryawanModel->getKaryawan(),
        ];

        return view('pages/tambah_kak', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('file_kak');

        $allowedExtensions = ['doc', 'docx', 'jpg', 'png', 'pdf'];
        if ($file->isValid() && !$file->hasMoved() && in_array($file->getClientExtension(), $allowedExtensions)) {
            $newName = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid(). '.' . $file->getClientExtension();
            $file->move('doc/', $newName);
            $fileKak = $newName;
        } else {
            session()->setFlashdata('error', 'File yang diupload harus bertipe: doc, docx, jpg, png, pdf.');
            return redirect()->back()->withInput();
        }

        $this->KerangkaKerjaModel->insert([
            'id_proker' => $this->request->getVar('id_proker'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'lokasi' => $this->request->getVar('lokasi'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'sasaran' => $this->request->getVar('sasaran'),
            'target' => $this->request->getVar('target'),
            'anggaran_dibutuhkan' => $this->request->getVar('anggaran_dibutuhkan'),
            'file' => $fileKak,
            'status' => "Diproses",
        ]);
        session()->setFlashdata('success', 'Data Kerangka Acuan Kerja berhasil disimpan!');

        return redirect()->to('/kak');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Kerangka Acuan Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Kerangka Acuan Kerja', 'Detail Kerangka Acuan Kerja'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaWithUserById($id),
        ];

        return view('pages/detail_kak', $data);
    }
}
