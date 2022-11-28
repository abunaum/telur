<?php

namespace App\Controllers\FunctionBendahara;

use App\Controllers\BaseController;

class Put extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
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

            case 'notifikasi':
                $tele_id = $this->request->getVar('tele_id');
                $kode = RandomUC(6);
                $tele = $this->Telegram->where('user_id', user()->id)->first();
                $this->Telegram->save([
                    'id' => $tele['id'],
                    'tele_id' => $tele_id,
                    'kode' => $kode
                ]);
                $send = kirimpesan($tele_id, "Kode verifikasi anda adalah $kode");
                if ($send) {
                    session()->setFlashdata('pesan', 'Kode verifikasi berhasil terkirim');
                    return redirect()->to(previous_url());
                } else {
                    session()->setFlashdata('error', 'Gagal kirim kode verifikasi<br>pastikan sudah chat bot dan id sudah benar');
                    return redirect()->to(previous_url());
                }
                break;

            case 'reset-tele':
                $tele = $this->Telegram->where('user_id', user()->id)->first();
                $this->Telegram->save([
                    'id' => $tele['id'],
                    'tele_id' => "",
                    'kode' => "",
                    'status' => "invalid"
                ]);
                session()->setFlashdata('pesan', 'Id Telegram berhasil di reset');
                return redirect()->to(previous_url());

                break;

            case 'verif-notifikasi':
                $getkode = $this->request->getVar('kode');
                if (!$this->validate([
                    'kode' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Kode harus di isi',
                        ]
                    ]
                ])) {
                    session()->setFlashdata('error', 'Validasi kode gagal');
                    return redirect()->to(previous_url())->withInput();
                }
                $tele = $this->Telegram->where('user_id', user()->id)->first();
                $kode = $tele['kode'];
                if ($getkode !== $kode) {
                    session()->setFlashdata('error', 'Validasi kode gagal, Kode tidak sama');
                    return redirect()->to(previous_url());
                }

                $this->Telegram->save([
                    'id' => $tele['id'],
                    'kode' => "",
                    'status' => "valid"
                ]);
                session()->setFlashdata('pesan', 'Notifikasi berhasil aktif');
                return redirect()->to(previous_url());

                break;


            default:
                return redirect()->to(base_url('setting'));
                break;
        }
    }

    public function order($value = "", $id = 0)
    {
        if ($id < 1) {
            session()->setFlashdata('error', 'Id produk tidak valid');
            return redirect()->to(previous_url());
        }

        $Transaksi = $this->Transaksi->where('id', $id)->first();
        if (!$Transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak ditemukan');
            return redirect()->to(previous_url());
        }
        switch ($value) {
            case 'kirim':
                $this->Transaksi->save([
                    'id' => $id,
                    'status' => 2
                ]);
                session()->setFlashdata('pesan', $Transaksi['kode'] . ' berhasil di kirim. <br>Silahakan cetak Invoice.');
                return redirect()->to(previous_url());
                break;


            default:
                return redirect()->to(previous_url());
                break;
        }
    }
}
