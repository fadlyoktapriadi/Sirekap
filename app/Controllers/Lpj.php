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
        // dd($this->KerangkaKerjaModel->getKerjangkaKerjaLpj());
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
}
