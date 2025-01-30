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

    public function filter()
    {
        $data = [
            'title' => 'Data Kerangka Acuan Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Kerangka Acuan Kerja'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaByFilter($this->request->getVar('unit_kerja')),
        ];

        return view('pages/kerangkakerja', $data);
    }

    public function tambah()
    {
        $session = $this->session->get();

        $data = [
            'title' => 'Tambah Kerangka Acuan Kerja',
            'user_login' => $session,
            'breadcrumb' => ['Data Kerangka Acuan Kerja', 'Tambah Kerangka Acuan Kerja'],
            'penanggung_jawab' => $this->KaryawanModel->getKaryawanByUnit($session['unit_kerja']),
        ];

        return view('pages/tambah_kak', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('file_kak');

        $anggaran_dibutuhkan = (int) trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('anggaran_dibutuhkan')));

        $pagu_anggaran = (int) $this->PaguAnggaranModel->getPaguAnggaran(date('Y'))['jumlah_anggaran'];

        if ($anggaran_dibutuhkan > $pagu_anggaran) {
            session()->setFlashdata('error', 'Anggaran dibutuhkan melebihi pagu anggaran.');
            return redirect()->back()->withInput();
        }

        $allowedExtensions = ['doc', 'docx', 'jpg', 'png', 'pdf'];
        if ($file->isValid() && !$file->hasMoved() && in_array($file->getClientExtension(), $allowedExtensions)) {
            $newName = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . uniqid() . '.' . $file->getClientExtension();
            $file->move('doc/kak/', $newName);
            $fileKak = $newName;
        } else {
            session()->setFlashdata('error', 'File yang diupload harus bertipe: doc, docx, jpg, png, pdf.');
            return redirect()->back()->withInput();
        }

        $this->KerangkaKerjaModel->insert([
            'program_kerja' => $this->request->getVar('program_kerja'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'sasaran' => $this->request->getVar('sasaran'),
            'target' => $this->request->getVar('target'),
            'anggaran_dibutuhkan' => $anggaran_dibutuhkan,
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
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaById($id),
        ];

        return view('pages/detail_kak', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kerangka Acuan Kerja',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Kerangka Acuan Kerja', 'Edit Kerangka Acuan Kerja'],
            'kak' => $this->KerangkaKerjaModel->getKerjangkaKerjaById($id),
            'penanggung_jawab' => $this->KaryawanModel->getKaryawanByUnit($this->session->get('unit_kerja')),
        ];

        return view('pages/edit_kak', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_kak');

        $anggaran_dibutuhkan = intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('anggaran_dibutuhkan'))));

        $data = [
            'program_kerja' => $this->request->getVar('program_kerja'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'penanggung_jawab' => $this->request->getVar('penanggung_jawab'),
            'sasaran' => $this->request->getVar('sasaran'),
            'target' => $this->request->getVar('target'),
            'anggaran_dibutuhkan' => $anggaran_dibutuhkan,
        ];

        if ($this->request->getFile('file_kak')->isValid()) {
            $file = $this->request->getFile('file_kak');
            $file_lama = $this->request->getVar('file_lama');
            $allowedExtensions = ['doc', 'docx', 'jpg', 'png', 'pdf'];

            if ($file->isValid() && !$file->hasMoved() && in_array($file->getClientExtension(), $allowedExtensions)) {
                if (file_exists('doc/kak/' . $file_lama)) {
                    unlink('doc/kak/' . $file_lama);
                }
                $newName = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->request->getVar('nama_kegiatan')) . '_' . uniqid() . '.' . $file->getClientExtension();
                $file->move('doc/kak/', $newName);
                $fileKak = $newName;
                $data['file'] = $fileKak;
            } elseif ($file->getError() != 4) {
                session()->setFlashdata('error', 'File yang diupload harus bertipe: doc, docx, jpg, png, pdf.');
                return redirect()->back()->withInput();
            }
        }

        $this->KerangkaKerjaModel->update($id, $data);

        session()->setFlashdata('success', 'Data Kerangka Acuan Kerja berhasil diperbarui!');
        return redirect()->to('/kak');
    }

    public function hapus($id)
    {
        $kak = $this->KerangkaKerjaModel->find($id);
        if (file_exists('doc/kak/' . $kak['file'])) {
            unlink('doc/kak/' . $kak['file']);
        }
        $this->KerangkaKerjaModel->delete($id);

        session()->setFlashdata('success', 'Data Kerangka Acuan Kerja berhasil dihapus!');
        return redirect()->to('/kak');
    }

    public function validasi()
    {
        $id = $this->request->getVar('id_kak');
        $status = $this->request->getVar('status');
        $data = [];

        $pagu_anggaran = (int) $this->PaguAnggaranModel->getPaguAnggaran(date('Y'))['jumlah_anggaran'];

        if ($status == "Diterima") {

            $anggaran_disetujui = intval(trim(str_replace(['Rp', ' ', '.', ','], '', $this->request->getVar('anggaran_disetujui'))));

            if ($anggaran_disetujui > $pagu_anggaran) {
                session()->setFlashdata('error', 'Anggaran disetujui melebihi pagu anggaran.');
                return redirect()->back()->withInput();
            }

            $riwayat_anggaran = [
                'id_kak' => $id,
                'jumlah_anggaran' => $anggaran_disetujui,
                'label_anggaran' => 'Keluar',
            ];

            $data = [
                'anggaran_disetujui' => $anggaran_disetujui,
                'tanggal_diterima' => date('Y-m-d'),
                'catatan_status' => null,
            ];

            $anggaran_lama = $this->request->getVar('anggaran_lama');
            if ($anggaran_lama == 0 || $anggaran_lama == null) {
                $anggaran = $pagu_anggaran - $anggaran_disetujui;
                $this->RiwayatAnggaranModel->insert($riwayat_anggaran);
            } else if ($anggaran_lama > $anggaran_disetujui) {
                $anggaran = $pagu_anggaran + ($anggaran_lama - $anggaran_disetujui);
                $this->RiwayatAnggaranModel->updateRiwayatAnggaran($id, $anggaran);
            } else {
                $anggaran = $pagu_anggaran - ($anggaran_disetujui - $anggaran_lama);
                $this->RiwayatAnggaranModel->updateRiwayatAnggaran($id, $anggaran);
            }

            $this->PaguAnggaranModel->updatePaguAnggaran(date('Y'), $anggaran);


        } else if ($status == 'Perlu Perbaikan' || $status == 'Ditolak') {

            $data = [
                'anggaran_disetujui' => null,
                'tanggal_diterima' => null,
                'catatan_status' => $this->request->getVar('catatan_status'),
            ];

            $riwayat = $this->RiwayatAnggaranModel->getRiwayatAnggaran($id);

            if ($riwayat) {
                $anggaran = $pagu_anggaran + $riwayat['jumlah_anggaran'];
                $this->PaguAnggaranModel->updatePaguAnggaran(date('Y'), $anggaran);
                $this->RiwayatAnggaranModel->delete($riwayat['id_riwayat_anggaran']);
            }
        }

        $data['status'] = $status;

        $this->KerangkaKerjaModel->update($id, $data);

        session()->setFlashdata('success', 'Data Kerangka Acuan Kerja berhasil ' . strtolower($data['status']) . '!');
        return redirect()->to('/kak/detail/' . $id);
    }
}
