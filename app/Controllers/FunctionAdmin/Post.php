<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Post extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function tambah_produk()
    {
        if (!$this->validate([
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus di isi',
                ]
            ],
            'stok' => [
                'rules'  => 'required|is_natural',
                'errors' => [
                    'required' => 'Stok harus di isi',
                    'is_natural' => 'Stok tidak valid'
                ]
            ],
            'harga' => [
                'rules'  => 'required|is_natural',
                'errors' => [
                    'required' => 'Harga harus di isi',
                    'is_natural' => 'Harga tidak valid'
                ]
            ],
            'minorder' => [
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Minimal order harus di isi',
                    'is_natural_no_zero' => 'Minimal order tidak valid'
                ]
            ],
        ])) {
            session()->setFlashdata('error', 'Gagal menambah produk');
            return redirect()->to(base_url('/produk'))->withInput();
        }
        $nama = $this->request->getVar("nama");
        $stok = $this->request->getVar("stok");
        $harga = $this->request->getVar("harga");
        $minorder = $this->request->getVar("minorder");
        $data = [
            "nama" => $nama,
            "stok" => (int)$stok,
            "harga" => (int)$harga,
            "minorder" => (int)$minorder,
        ];

        $produk =  $this->Produk;
        $produk->insert($data);
        session()->setFlashdata('pesan', 'Berhasil menambah produk');
        $pesan = "Ada produk baru nih \nNama Produk : $nama \nHarga : $harga @Kg \nStok : $stok Kg \nMinimal Order : $minorder Kg \n \nTunggu apalagi?, Yuk buruan di order :)";
        kirim_user($pesan);
        $pesanb = "Admin menambah produk baru \nNama Produk : $nama \nHarga : $harga @Kg \nStok : $stok Kg \nMinimal Order : $minorder Kg";
        kirim_bendahara($pesanb);
        return redirect()->to(base_url('/produk'));
    }

    public function tambah_user()
    {
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
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
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus di isi',
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
            "alamat" => $alamat,
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

        $telegram =  $this->Telegram;
        $telegram->insert([
            "user_id" => $iduser
        ]);

        session()->setFlashdata('pesan', 'Berhasil menambah user');
        return redirect()->to(base_url('/user'));
    }

    public function tambah_bendahara()
    {
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
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
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus di isi',
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
            session()->setFlashdata('error', 'Gagal menambah bendahara');
            return redirect()->to(base_url('/bendahara'))->withInput();
        }
        $fixpass = \Myth\Auth\Password::hash($password);

        $data = [
            "username" => $username,
            "email" => $email,
            "password_hash" => $fixpass,
            "fullname" => $nama,
            "active" => 1,
            "alamat" => $alamat,
            "force_pass_reset" => 0
        ];

        $user =  $this->User;
        $user->insert($data);
        $iduser = $user->getInsertID();

        $group =  $this->Group;
        $group->insert([
            "group_id" => 2,
            "user_id" => $iduser
        ]);

        $telegram =  $this->Telegram;
        $telegram->insert([
            "user_id" => $iduser
        ]);

        session()->setFlashdata('pesan', 'Berhasil menambah bendahara');
        return redirect()->to(base_url('/bendahara'));
    }
}
