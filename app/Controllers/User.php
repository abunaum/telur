<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Dashboard"
        ];
        return view('dashboard', $data);
    }

    public function produk()
    {
        $produk = $this->Produk->findAll();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Produk",
            'produk' => $produk,
            'validation' => \Config\Services::validation()
        ];
        return view('user/produk', $data);
    }

    public function detailorder($id = 0)
    {
        $transaksi = $this->Transaksi;
        $transaksi->join('produk', 'produk.id = produk_id', 'LEFT');
        $transaksi->select('transaksi.*');
        $transaksi->select('produk.nama as nama_produk');
        $transaksi->where('transaksi.id', $id);
        $transaksi = $transaksi->first();
        if (!$transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(previous_url());
        }
        if ($transaksi['user_id'] !== user()->id) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(base_url());
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Order Detail",
            'transaksi' => $transaksi,
            'validation' => \Config\Services::validation()
        ];
        return view('user/detail_order', $data);
    }

    public function transaksi()
    {
        $transaksi = $this->Transaksi;
        $transaksi->join('produk', 'produk.id = produk_id', 'LEFT');
        $transaksi->select('transaksi.*');
        $transaksi->select('produk.nama as nama_produk');
        $transaksi->where('transaksi.user_id', user()->id);
        $transaksi = $transaksi->findAll();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Transaksi",
            'transaksi' => $transaksi,
            'validation' => \Config\Services::validation()
        ];
        return view('user/transaksi', $data);
    }

    public function setting()
    {
        helper('group');
        $user = $this->MUser->where('id', user()->id)->first();
        $getgroup = getgroup($user->id);
        $group = $getgroup['name'];
        $telegram = $this->Telegram->where('user_id', user()->id)->first();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Setting",
            'user' => $user,
            'group' => $group,
            'telegram' => $telegram,
            'validation' => \Config\Services::validation()
        ];
        return view('setting', $data);
    }
}
