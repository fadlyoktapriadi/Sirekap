<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct() {
        $this->session = \Config\Services::session();   
    }

    public function index(): string
    {
        $data = [
            'title' => 'Login | Sirekap',
        ];

        return view('pages/login', $data);
    }

    public function login(){

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
            ];

            return view('pages/dashboard', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
