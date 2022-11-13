<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Post extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function tambah_user()
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        if (!$this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus di isi',
                ]
            ],
            'email' => [
                'rules'  => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'Email harus di isi',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid',
                ]
            ],
            'username' => [
                'rules'  => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus di isi',
                    'is_unique' => 'Username sudah terdaftar',
                ]
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus di isi',
                ]
            ]
        ])) {
            session()->setFlashdata('error', 'Gagal menambah user');
            return redirect()->to(base_url('/user'))->withInput();
        }
        $fixpass = \Myth\Auth\Password::hash($password);

        $data = [
            "username" => $username,
            "email" => $email,
            "password_hash" => $fixpass,
            "fullname" => $nama,
            "active" => 1,
            "force_pass_reset" => 0
        ];

        $user =  $this->User;
        $user->insert($data);
        $iduser = $user->getInsertID();

        $group =  $this->Group;
        $group->insert([
            "group_id" => 3,
            "user_id" => $iduser
        ]);

        session()->setFlashdata('pesan', 'Berhasil menambah user');
        return redirect()->to(base_url('/user'));
    }
}
