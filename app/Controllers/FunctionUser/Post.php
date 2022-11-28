<?php

namespace App\Controllers\FunctionUser;

use App\Controllers\BaseController;

class Post extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function order($id = 0)
    {
        if ($id < 1) {
            session()->setFlashdata('error', 'Order tidak valid');
            return redirect()->to(previous_url());
        }
        $produk = $this->Produk->where('id', $id)->first();
        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak valid');
            return redirect()->to(previous_url());
        }
        if (!$this->request->getVar('order')) {
            session()->setFlashdata('error', 'Jumlah order tidak valid');
            return redirect()->to(previous_url());
        }
        $order = $this->request->getVar('order');
        if ($order < $produk['minorder']) {
            session()->setFlashdata('error', 'Minimal order produk ' . $produk['nama'] . ' adalah ' . $produk['minorder'] . ' Kg');
            return redirect()->to(previous_url());
        }
        $kode = microtime(true);
        $trans = $this->Transaksi;
        $trans->save(
            [
                'produk_id' => $produk['id'],
                'user_id'   => user()->id,
                'kode'      => $kode,
                'jumlah'    => $order,
                'total_harga' => $produk['harga'] * $order,
                'status'    => 1
            ]
        );
        session()->setFlashdata('pesan', 'Produk ' . $produk['nama'] . ' berhasil di order. <br>Harap segera melakukan pembayaran');
        return redirect()->to(base_url('order/detail/' . $trans->getInsertID()));
    }
}
