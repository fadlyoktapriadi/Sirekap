<?php

namespace App\Controllers;

class Lpj extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Data LPJ KAK',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data LPJ KAK'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaLpj(),
        ];

        return view('pages/lpj', $data);
    }

    public function tambah($id_kak)
    {
        $data = [
            'title' => 'Tambah LPJ',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data LPJ KAK', 'Tambah LPJ'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaById($id_kak),
        ];

        return view('pages/tambah_lpj', $data);
    }

    public function simpan()
    {

        $file_lpj = $this->request->getFile('file_lpj');
        $file_dokumentasi = $this->request->getFile('dokumentasi');

        $allowedExtensions = ['doc', 'docx', 'jpg', 'png', 'pdf', 'xls', 'xlsx'];

        if ($file_lpj->isValid() && !$file_lpj->hasMoved() && in_array($file_lpj->getClientExtension(), $allowedExtensions)) {
            $newName = 'LPJ_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file_lpj->getClientExtension();
            $file_lpj->move('doc/lpj', $newName);
            $file_lpj = $newName;
        } else {
            session()->setFlashdata('error', 'File LPJ yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
            return redirect()->back()->withInput();
        }

        if ($file_dokumentasi->isValid() && !$file_dokumentasi->hasMoved() && in_array($file_dokumentasi->getClientExtension(), $allowedExtensions)) {
            $newName = 'Dokumentasi_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file_dokumentasi->getClientExtension();
            $file_dokumentasi->move('doc/dokumentasi', $newName);
            $file_dokumentasi = $newName;
        } else {
            session()->setFlashdata('error', 'File Dokumentasi yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
            return redirect()->back()->withInput();
        }

        $this->LpjModel->insert([
            'id_kak' => $this->request->getVar('id_kak'),
            'capaian_pelaksanaan' => $this->request->getVar('capaian_pelaksanaan'),
            'anggaran_digunakan' => $this->request->getVar('anggaran_digunakan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'file_lpj' => $file_lpj,
            'dokumentasi' => $file_dokumentasi,
        ]);

        $this->KerangkaKerjaModel->update($this->request->getVar('id_kak'), ['status' => 'Menunggu Persetujuan LPJ']);

        session()->setFlashdata('success', 'Lembar Pertanggung Jawaban berhasil disimpan!');

        return redirect()->to('/lpj');

    }
}
