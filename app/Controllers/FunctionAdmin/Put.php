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
        return redirect()->to(previous_url());
    }

    public function alamat_user($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        if (!$this->validate([
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus di isi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', 'Gagal edit alamat');
            return redirect()->to(previous_url())->withInput();
        }
        $user = $this->User->where('id', $id)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Id user tidak valid');
            return redirect()->to(previous_url());
        }
        $alamat = $this->request->getVar('alamat');
        $username = $user['username'];

        $data = [
            "id" => $id,
            "alamat" => $alamat,
        ];

        $this->User->save($data);
        session()->setFlashdata('pesan', "Berhasil mengganti alamat @$username menjadi $alamat");
        return redirect()->to(previous_url());
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

            case 'alamat':
                $alamat = $this->request->getVar('alamat');
                if (!$this->validate([
                    'alamat' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Alamat harus di isi',
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal edit alamat');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->User->save([
                    'id' => user()->id,
                    'alamat' => $alamat
                ]);
                session()->setFlashdata('pesan', 'Alamat berhasil di edit');
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
                session()->setFlashdata('error', 'Tidak ada settingan');
                return redirect()->to(base_url('setting'));
                break;
        }
    }

    public function produk($id = 0, $type = 'gak ada')
    {
        if ($id < 1) {
            session()->setFlashdata('error', 'Id produk tidak valid');
            return redirect()->to(previous_url());
        }

        $produk = $this->Produk->where('id', $id)->first();
        if (!$produk) {
            session()->setFlashdata('error', 'Id produk tidak ditemukan');
            return redirect()->to(previous_url());
        }

        $oldname = $produk['nama'];
        $oldstok = $produk['stok'];
        $oldharga = number_to_currency($produk['harga'], 'IDR', 'id_ID', 0);
        $oldminorder = $produk['minorder'];
        switch ($type) {
            case 'nama':
                $nama = $this->request->getVar('nama');
                if (!$this->validate([
                    'nama' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Nama harus di isi',
                        ]
                    ]
                ])) {
                    session()->setFlashdata('error', 'Nama harus di isi');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->Produk->save([
                    'id' => $id,
                    'nama' => $nama
                ]);
                session()->setFlashdata('pesan', "Nama produk $oldname berhasil diubah menjadi $nama");
                $pesan = "Ada perubahan nama produk nih \nNama Produk : '$oldname' menjadi '$nama' \nHarga : $oldharga @Kg \nStok : $oldstok Kg \nMinimal Order : $oldminorder Kg \n \nTunggu apalagi?, Yuk buruan di order sebelum kehabisan :)";
                kirim_user($pesan);
                $pesanb = "Admin merubah nama pruduk \nNama Produk : '$oldname' menjadi '$nama' \nHarga : $oldharga @Kg \nStok : $oldstok Kg \nMinimal Order : $oldminorder Kg";
                kirim_bendahara($pesanb);
                return redirect()->to(previous_url())->withInput();
                break;

            case 'minorder':
                $minorder = $this->request->getVar('minorder');
                if (!$this->validate([
                    'minorder' => [
                        'rules'  => 'required|is_natural_no_zero',
                        'errors' => [
                            'required' => 'Minimal order harus di isi',
                            'is_natural_no_zero' => 'Minimal order tidak valid'
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal update minimal order');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->Produk->save([
                    'id' => $id,
                    'minorder' => $minorder
                ]);
                session()->setFlashdata('pesan', "Minimal order berhasil diubah menjadi $minorder");
                $pesan = "Ada perubahan ketentuan order produk nih \nNama Produk : $oldname \nHarga : $oldharga @Kg \nStok : $oldstok Kg \nMinimal Order : '$oldminorder Kg' menjadi '$minorder Kg' \n \nTunggu apalagi?, Yuk buruan di order sebelum kehabisan :)";
                kirim_user($pesan);
                $pesanb = "Admin merubah ketentuan order pruduk \nNama Produk : $oldname \nHarga : $oldharga @Kg \nStok : $oldstok Kg \nMinimal Order : '$oldminorder Kg' menjadi '$minorder Kg'";
                kirim_bendahara($pesanb);
                return redirect()->to(previous_url())->withInput();
                break;

            case 'harga':
                $harga = $this->request->getVar('harga');
                if (!$this->validate([
                    'harga' => [
                        'rules'  => 'required|is_natural',
                        'errors' => [
                            'required' => 'Harga harus di isi',
                            'is_natural' => 'Harga tidak valid'
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal update minimal order');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->Produk->save([
                    'id' => $id,
                    'harga' => $harga
                ]);
                $newharga = number_to_currency($harga, 'IDR', 'id_ID', 0);
                session()->setFlashdata('pesan', "Harga berhasil diubah menjadi $newharga");
                $pesan = "Ada perubahan harga produk nih \nNama Produk : $oldname \nHarga : '$oldharga @Kg' menjadi '$newharga @Kg' \nStok : $oldstok Kg \nMinimal Order : $oldminorder Kg \n \nTunggu apalagi?, Yuk buruan di order sebelum kehabisan :)";
                kirim_user($pesan);
                $pesanb = "Admin merubah harga pruduk \nNama Produk : $oldname \nHarga : '$oldharga @Kg' menjadi '$newharga @Kg' \nStok : $oldstok Kg \nMinimal Order : $oldminorder Kg";
                kirim_bendahara($pesanb);
                return redirect()->to(previous_url())->withInput();
                break;

            case 'stok':
                $stok = $this->request->getVar('stok');
                if (!$this->validate([
                    'stok' => [
                        'rules'  => 'required|is_natural',
                        'errors' => [
                            'required' => 'Stok harus di isi',
                            'is_natural' => 'Stok tidak valid'
                        ]
                    ],
                ])) {
                    session()->setFlashdata('error', 'Gagal update minimal order');
                    return redirect()->to(previous_url())->withInput();
                }
                $this->Produk->save([
                    'id' => $id,
                    'stok' => $stok
                ]);
                session()->setFlashdata('pesan', "Stok berhasil diubah menjadi $stok");
                $pesan = "Ada perubahan stok produk nih \nNama Produk : $oldname \nHarga : $oldharga @Kg \nStok : '$oldstok Kg' menjadi '$stok Kg' \nMinimal Order : $oldminorder Kg \n \nTunggu apalagi?, Yuk buruan di order sebelum kehabisan :)";
                kirim_user($pesan);
                $pesanb = "Admin merubah stok pruduk \nNama Produk : $oldname \nHarga : $oldharga @Kg \nStok : '$oldstok Kg' menjadi '$stok Kg' \nMinimal Order : $oldminorder Kg";
                kirim_bendahara($pesanb);
                return redirect()->to(previous_url())->withInput();
                break;

            default:
                session()->setFlashdata('error', 'Gagal update produk');
                return redirect()->to(previous_url());
                break;
        }
    }
}
