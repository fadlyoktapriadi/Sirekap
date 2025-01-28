<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Login | Sirekap',
        ];

        return view('pages/login', $data);
    }

    public function login()
    {

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->UsersModel->where('username', $username)->first();

        if ($user) {
            $pass = $user['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {

                $user_login = $this->UsersModel->getUserKaryawan($user['NIP']);

                $ses_data = [
                    'username' => $user_login['username'],
                    'nama_karyawan' => $user_login['nama_karyawan'],
                    'unit_kerja' => $user_login['unit_kerja'],
                    'role' => $user_login['role'],
                    'logged_in' => true
                ];

                $this->session->set($ses_data);

                return redirect()->to('/dashboard');

            } else {
                $this->session->setFlashdata('error', 'Password salah. Silahkan coba lagi.');
                return redirect()->to('/');
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan. Silahkan coba lagi.');
            return redirect()->to('/');
        }
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'user_login' => $this->session->get(),
            'total_karyawan' => $this->KaryawanModel->countAll(),
            'total_kak' => $this->KerangkaKerjaModel->countAll(),
            'total_kak_berjalan' => $this->KerangkaKerjaModel->countKakBerjalan(),
            'total_kak_selesai' => $this->KerangkaKerjaModel->countKakSelesai(),
            'statusKegiatan' => $this->KerangkaKerjaModel->statusKegiatan(),
            'jumlahPaguAnggaran' => $this->PaguAnggaranModel->getPaguAnggaran(date('Y'))['jumlah_anggaran'] ?? 0,
            'jumlahAnggaranDigunakan' => $this->LpjModel->jumlahAnggaranDigunakan()['anggaran_digunakan'],
            'jumlahKegiatanUnitEKKM' => $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Esensial dan Keperawatan Kesehatan Masyarakat'),
            'jumlahKegiatanUnitPengembangan' => $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Pengembangan'),
            'jumlahKegiatanUnitKL' => $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Kefarmasian & Laboratorium'),

        ];

        return view('pages/dashboard', $data);
    }

    public function getKakDataJson($year)
    {
        $kakData = $this->KerangkaKerjaModel->getKakCountByMonth($year);

        return $this->response->setJSON($kakData);
    }

    public function getLpjDataJson($year)
    {
        $lpjData = $this->KerangkaKerjaModel->getLpjCountByMonth($year);

        return $this->response->setJSON($lpjData);
    }

    public function getKakSelesaiDataJson($year)
    {
        $kakSelesaiData = $this->KerangkaKerjaModel->getKakSelesaiByMonth($year);

        return $this->response->setJSON($kakSelesaiData);
    }

    public function getPieUnit()
    {

        $ekm = $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Esensial dan Keperawatan Kesehatan Masyarakat');
        $pengembangan = $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Pengembangan');
        $kl = $this->KerangkaKerjaModel->getKerjangkaKerjaUnit('Kefarmasian & Laboratorium');

        $total = $ekm + $pengembangan + $kl;

        // dd($kl);
        $rekm = ($ekm / $total) * 100;
        $rpengembangan = ($pengembangan / $total) * 100;
        $rkl = ($kl / $total) * 100;

        return $this->response->setJSON([
            $rekm,
            $rpengembangan,
            $rkl
        ]);
    }

    public function kinerjaUnit()
    {

        $total_kak = $this->KerangkaKerjaModel->countAll();

        $total_kak_selesai = $this->KerangkaKerjaModel->countKakSelesai();

        return $this->response->setJSON(number_format($total_kak_selesai / $total_kak * 100));

    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
