<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Dashboard"
        ];
        return view('admin/index', $data);
    }

    public function user()
    {
        helper('group_helper');
        $getuser = $this->MUser;
        $getuser->select('id');
        $getuser->select('email');
        $getuser->select('username');
        $getuser->select('fullname');
        $alluser = $getuser->findAll();
        $user = [];
        foreach ($alluser as $usr) {
            $u = $usr->toArray();
            $group = $this->Group->where('user_id', $u['id'])->first();
            $idgroup = $group['group_id'];
            $getgroup = getgroup($idgroup);
            $fixusr = array_merge($u, ['group' => $getgroup]);

            array_push($user, $fixusr);
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "User",
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user', $data);
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

    public function transaksi()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Transaksi"
        ];
        return view('admin/index', $data);
    }

    public function bendahara()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Bendahara"
        ];
        return view('admin/index', $data);
    }
}
