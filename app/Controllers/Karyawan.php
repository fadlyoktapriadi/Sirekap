<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Data Karyawan',
            'user_login' => $this->session->get(),
            'breadcrumb' => ['Data Karyawan'],
            'karyawan' => $this->KaryawanModel->getKaryawan()
        ];

        return view('pages/karyawan', $data);
    }
}
