<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Delete extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function produk($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $produk = $this->Produk->where('id', $id)->first();
        $nama = $produk['nama'];
        $this->Produk->delete($id);
        session()->setFlashdata('pesan', "Berhasil menghapus $nama");
        $pesan = "Yah, Produk '$nama' sudah tidak tersedia lagi (Dihapus Oleh Admin) dan tidak dapat di order lagi";
        kirim_user($pesan);
        $pesanb = "Produk '$nama' sudah dihapus oleh admin";
        kirim_bendahara($pesanb);
        return redirect()->to(base_url('/produk'));
    }

    public function user($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $this->User->delete($id);
        session()->setFlashdata('pesan', "Berhasil menghapus $email");
        return redirect()->to(base_url('/user'));
    }

    public function bendahara($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $this->User->delete($id);
        session()->setFlashdata('pesan', "Berhasil menghapus $email");
        return redirect()->to(base_url('/bendahara'));
    }
}
