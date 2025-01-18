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

    public function filter(): string
    {
        $data = [
            'title' => 'Data LPJ KAK',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data LPJ KAK'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaLpjWithFilter($this->request->getVar('unit_kerja')),
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
            $file_lpj->move('doc/lpj/', $newName);
            $file_lpj = $newName;
        } else {
            session()->setFlashdata('error', 'File LPJ yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
            return redirect()->back()->withInput();
        }

        if ($file_dokumentasi->isValid() && !$file_dokumentasi->hasMoved() && in_array($file_dokumentasi->getClientExtension(), $allowedExtensions)) {
            $newName = 'Dokumentasi_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file_dokumentasi->getClientExtension();
            $file_dokumentasi->move('doc/dokumentasi/', $newName);
            $file_dokumentasi = $newName;
        } else {
            session()->setFlashdata('error', 'File Dokumentasi yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
            return redirect()->back()->withInput();
        }

        $id_kak = $this->request->getVar('id_kak');

        $data_kunjungan = [
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Burujul Kulon',
                'jumlah_kunjungan' => $this->request->getVar('burujul_kulon'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Burujul Wetan',
                'jumlah_kunjungan' => $this->request->getVar('burujul_wetan'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Cicadas',
                'jumlah_kunjungan' => $this->request->getVar('cicadas'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Jatisura',
                'jumlah_kunjungan' => $this->request->getVar('jatisura'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Jatiwangi',
                'jumlah_kunjungan' => $this->request->getVar('jatiwangi'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Mekarsari',
                'jumlah_kunjungan' => $this->request->getVar('mekarsari'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Surawangi',
                'jumlah_kunjungan' => $this->request->getVar('surawangi'),
            ],

            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Sutawangi',
                'jumlah_kunjungan' => $this->request->getVar('sutawangi'),
            ],
        ];

        $this->KunjunganModel->insertBatch($data_kunjungan);

        $anggaran_digunakan = intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('anggaran_digunakan'))));

        $this->LpjModel->insert([
            'id_kak' => $id_kak,
            'anggaran_digunakan' => $anggaran_digunakan,
            'keterangan' => $this->request->getVar('keterangan'),
            'file_lpj' => $file_lpj,
            'dokumentasi' => $file_dokumentasi,
        ]);

        $this->KerangkaKerjaModel->update($id_kak, ['status' => 'Menunggu Persetujuan LPJ']);

        session()->setFlashdata('success', 'Lembar Pertanggung Jawaban berhasil disimpan!');

        return redirect()->to('/lpj');

    }

    public function detail($id)
    {

        $data = [
            'title' => 'Detail LPJ',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data LPJ KAK', 'Detail LPJ'],
            'lpj' => $this->LpjModel->getLpjById($id),
            'kunjungan' => $this->KunjunganModel->getKunjunganById($id),
        ];

        return view('pages/detail_lpj', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Detail LPJ',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data LPJ KAK', 'Ubah LPJ'],
            'lpj' => $this->LpjModel->getLpjById($id),
            'kunjungan' => $this->KunjunganModel->getKunjunganById($id),
        ];

        return view('pages/edit_lpj', $data);
    }

    public function update()
    {
        $id_lpj = $this->request->getVar('id_lpj');
        $id_kak = $this->request->getVar('id_kak');

        $data_kunjungan = [
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Burujul Kulon',
                'jumlah_kunjungan' => $this->request->getVar('burujul_kulon'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Burujul Wetan',
                'jumlah_kunjungan' => $this->request->getVar('burujul_wetan'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Cicadas',
                'jumlah_kunjungan' => $this->request->getVar('cicadas'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Jatisura',
                'jumlah_kunjungan' => $this->request->getVar('jatisura'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Jatiwangi',
                'jumlah_kunjungan' => $this->request->getVar('jatiwangi'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Mekarsari',
                'jumlah_kunjungan' => $this->request->getVar('mekarsari'),
            ],
            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Surawangi',
                'jumlah_kunjungan' => $this->request->getVar('surawangi'),
            ],

            [
                'id_kak' => $id_kak,
                'nama_desa' => 'Sutawangi',
                'jumlah_kunjungan' => $this->request->getVar('sutawangi'),
            ],
        ];

        $anggaran_digunakan = intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('anggaran_digunakan'))));

        $data = [
            'anggaran_digunakan' => $anggaran_digunakan,
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        $file_lpj = $this->request->getFile('file_lpj');
        $file_dokumentasi = $this->request->getFile('dokumentasi');
        $allowedExtensions = ['doc', 'docx', 'jpg', 'png', 'pdf', 'xls', 'xlsx'];

        if ($file_lpj->isValid()) {
            $file_lama = $this->request->getVar('lpj_lama');
            if (file_exists('doc/lpj/' . $file_lama)) {
                unlink('doc/lpj/' . $file_lama);
            }
            if ($file_lpj->isValid() && !$file_lpj->hasMoved() && in_array($file_lpj->getClientExtension(), $allowedExtensions)) {
                $newName = 'LPJ_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file_lpj->getClientExtension();
                $file_lpj->move('doc/lpj', $newName);
                $file_lpj = $newName;
                $data['file_lpj'] = $file_lpj;
            } else {
                session()->setFlashdata('error', 'File LPJ yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
                return redirect()->back()->withInput();
            }
        }

        if ($file_dokumentasi->isValid()) {
            $file_lama = $this->request->getVar('dokumentasi_lama');
            if (file_exists('doc/dokumentasi/' . $file_lama)) {
                unlink('doc/dokumentasi/' . $file_lama);
            }
            if ($file_dokumentasi->isValid() && !$file_dokumentasi->hasMoved() && in_array($file_dokumentasi->getClientExtension(), $allowedExtensions)) {
                $newName = 'Dokumentasi_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file_dokumentasi->getClientExtension();
                $file_dokumentasi->move('doc/dokumentasi', $newName);
                $file_dokumentasi = $newName;
                $data['dokumentasi'] = $file_dokumentasi;
            } else {
                session()->setFlashdata('error', 'File Dokumentasi yang diupload harus bertipe: doc, docx, jpg, png, pdf, xls, xlsx.');
                return redirect()->back()->withInput();
            }
        }

        $this->KunjunganModel->updateBatch($data_kunjungan, 'nama_desa');

        $this->LpjModel->update($id_lpj, $data);

        session()->setFlashdata('success', 'Lembar Pertanggung Jawaban berhasil diubah!');

        return redirect()->to('/lpj/detail/' . $id_kak);

    }

    public function hapus($id_lpj)
    {

        $lpj = $this->LpjModel->find($id_lpj);

        if (file_exists('doc/lpj/' . $lpj['file_lpj'])) {
            unlink('doc/lpj/' . $lpj['file_lpj']);
        }

        if (file_exists('doc/dokumentasi/' . $lpj['dokumentasi'])) {
            unlink('doc/dokumentasi/' . $lpj['dokumentasi']);
        }
        $this->KerangkaKerjaModel->update($lpj['id_kak'], ['status' => 'Diterima']);

        $this->LpjModel->where('id_lpj', $id_lpj)->delete();

        session()->setFlashdata('success', 'Data Lembar Pertanggung Jawaban berhasil dihapus!');
        return redirect()->to('/lpj');
    }

    public function validasi()
    {
        $id_lpj = $this->request->getVar('id_lpj');

        $lpj = $this->LpjModel->find($id_lpj);

        $status = $this->request->getVar('status');

        if ($status == "Selesai") {
            $data['lpj_selesai'] = date('Y-m-d');
        }

        $data['catatan'] = $this->request->getVar('catatan');

        $this->LpjModel->update($id_lpj, $data);

        $this->KerangkaKerjaModel->update($lpj['id_kak'], ['status' => $status]);

        session()->setFlashdata('success', 'Data Lembar Pertanggung Jawaban berhasil disimpan!');
        return redirect()->to('/lpj/detail/' . $lpj['id_kak']);

    }

    public function riwayatLpj()
    {
        $data = [
            'title' => 'Data Riwayat KAK',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Riwayat KAK'],
            'kak' => $this->KerangkaKerjaModel->getRiwayatLpj(),
        ];

        return view('pages/riwayat_lpj', $data);
    }

    public function riwayatLpjFilter()
    {
        $data = [
            'title' => 'Data Riwayat KAK',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Riwayat KAK'],
            'kak' => $this->KerangkaKerjaModel->getRiwayatLpjWithFilter($this->request->getVar('unit_kerja')),
        ];

        return view('pages/riwayat_lpj', $data);
    }
}
