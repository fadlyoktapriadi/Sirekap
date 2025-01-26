<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function realisasiKegiatan(): string
    {
        $data = [
            'title' => 'Realisasi Kegiatan',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Realisasi Kegiatan'],
        ];

        return view('pages/realisasi_kegiatan', $data);
    }

    public function kegiatan()
    {
        $unit = $this->request->getGet('unit');
        $bulan = $this->request->getGet('bulan');

        if (!empty($bulan)) {
            $kegiatan = $this->KerangkaKerjaModel->realisasiKegiatan($unit, $bulan);
        } else {
            $kegiatan = $this->KerangkaKerjaModel->realisasiKegiatan($unit, date('m'));
        }

        $data = [
            'title' => 'Detail Realisasi Kegiatan',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Realisasi Kegiatan', 'Detail Realisasi Kegiatan'],
            'unit_kerja' => $unit,
            'bulan' => $bulan,
            'kegiatan' => $kegiatan,
        ];

        return view('pages/detail_realisasi_kegiatan', $data);
    }

    public function anggaran()
    {
        $bulan = $this->request->getGet('bulan');

        if (!empty($bulan)) {
            $anggaran = $this->KerangkaKerjaModel->realisasiAnggaran($bulan);
        } else {
            $anggaran = $this->KerangkaKerjaModel->realisasiAnggaran(date('m'));
        }


        $data = [
            'title' => 'Realisasi Anggaran',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Realisasi Anggaran'],
            'anggaran' => $anggaran,
            'jumlahPaguAnggaran' => $this->PaguAnggaranModel->getPaguAnggaran(date('Y'))['jumlah_anggaran'] ?? 0,
            'jumlahAnggaranDigunakan' => $this->LpjModel->jumlahAnggaranDigunakan()['anggaran_digunakan'],
        ];

        return view('pages/realisasi_anggaran', $data);
    }
}
