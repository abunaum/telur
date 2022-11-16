<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Put extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function user($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $username = $user['username'];
        $fixpass = \Myth\Auth\Password::hash($username);

        $data = [
            "id" => $id,
            "password_hash" => $fixpass,
        ];

        $this->User->save($data);
        session()->setFlashdata('pesan', "Berhasil mereset password $email");
        return redirect()->to(base_url('/user'));
    }

    public function bendahara($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $username = $user['username'];
        $fixpass = \Myth\Auth\Password::hash($username);

        $data = [
            "id" => $id,
            "password_hash" => $fixpass,
        ];

        $this->User->save($data);
        session()->setFlashdata('pesan', "Berhasil mereset password $email");
        return redirect()->to(base_url('/bendahara'));
    }

    public function setting($value = "")
    {
        switch ($value) {
            case 'nama':
                $nama = $this->request->getVar('nama');
                if (!$this->validate([
                    'nama' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Nama harus di isi',
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal edit nama');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->User->save([
                    'id' => user()->id,
                    'fullname' => $nama
                ]);
                session()->setFlashdata('pesan', 'Nama berhasil di edit');
                return redirect()->to(previous_url());
                break;

            case 'email':
                $email = $this->request->getVar('email');
                if (!$this->validate([
                    'email' => [
                        'rules'  => 'required|is_unique[users.email]|valid_email',
                        'errors' => [
                            'required' => 'Email harus di isi',
                            'is_unique' => 'Email sudah terdaftar',
                            'valid_email' => 'Email tidak valid',
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal edit email');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->User->save([
                    'id' => user()->id,
                    'email' => $email
                ]);
                session()->setFlashdata('pesan', 'Email berhasil di edit');
                return redirect()->to(previous_url());
                break;

            case 'username':
                $username = $this->request->getVar('username');
                if (!$this->validate([
                    'username' => [
                        'rules'  => 'required|is_unique[users.username]',
                        'errors' => [
                            'required' => 'Username harus di isi',
                            'is_unique' => 'Username sudah terdaftar',
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal edit username');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->User->save([
                    'id' => user()->id,
                    'username' => $username
                ]);
                session()->setFlashdata('pesan', 'Username berhasil di edit');
                return redirect()->to(previous_url());
                break;

            case 'password':
                $prevpassword = $this->request->getVar('prevpassword');
                $newpassword = $this->request->getVar('newpassword');
                $repeatpassword = $this->request->getVar('repeatpassword');
                $fixpass = \Myth\Auth\Password::hash($newpassword);
                $check = password_verify(base64_encode(hash('sha384', $prevpassword, true)), user()->password_hash);

                if (!$this->validate([
                    'prevpassword' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Password lama harus di isi',
                        ]
                    ],
                    'newpassword' => [
                        'rules'  => 'required|min_length[4]',
                        'errors' => [
                            'required' => 'Password baru harus di isi',
                            'min_length' => 'Password baru minimal 4 karakter'
                        ]
                    ],
                    'repeatpassword' => [
                        'rules'  => 'required|matches[newpassword]|min_length[4]',
                        'errors' => [
                            'required' => 'Password baru harus di isi',
                            'matches' => 'Password baru tidak sama',
                            'min_length' => 'Password baru minimal 4 karakter'
                        ]
                    ]
                ])) {
                    session()->setFlashdata('error', 'Gagal ganti password');
                    return redirect()->to(previous_url())->withInput();
                }
                if ($check) {
                    $this->User->save([
                        'id' => user()->id,
                        'password_hash' => $fixpass
                    ]);
                    session()->setFlashdata('pesan', 'Password berhasil di ganti');
                    return redirect()->to(previous_url());
                } else {
                    session()->setFlashdata('error', 'Gagal ganti password<br>Password lama salah');
                    return redirect()->to(previous_url());
                }
                break;

            default:
                return redirect()->to(base_url('settting'));
                break;
        }
    }
}
