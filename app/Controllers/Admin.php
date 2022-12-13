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
        return view('dashboard', $data);
    }

    public function user()
    {
        helper('group_helper');
        $getuser = $this->MUser;
        $getuser->select('id');
        $getuser->select('email');
        $getuser->select('username');
        $getuser->select('fullname');
        $getuser->select('alamat');
        $alluser = $getuser->findAll();
        $user = [];
        foreach ($alluser as $usr) {
            $u = $usr->toArray();
            $group = $this->Group->where('user_id', $u['id'])->first();
            $idgroup = $group['group_id'];
            $getgroup = getgroup($idgroup);
            if ($getgroup['name'] === 'user') {
                array_push($user, $u);
            }
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "User",
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user', $data);
    }

    public function transaksi()
    {
        $transaksi = $this->Transaksi;
        $transaksi->join('produk', 'produk.id = produk_id', 'LEFT');
        $transaksi->select('transaksi.*');
        $transaksi->select('produk.nama as nama_produk');
        $transaksi = $transaksi->findAll();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Transaksi",
            'transaksi' => $transaksi
        ];
        return view('admin/transaksi', $data);
    }

    public function detail_transaksi($id = 0)
    {
        $transaksi = $this->Transaksi;
        $transaksi->join('produk', 'produk.id = produk_id', 'RIGHT');
        $transaksi->join('users', 'users.id = user_id', 'RIGHT');
        $transaksi->select('transaksi.*');
        $transaksi->select('transaksi.status as status_transaksi');
        $transaksi->select('users.username');
        $transaksi->select('users.fullname');
        $transaksi->select('users.email');
        $transaksi->select('users.alamat');
        $transaksi->select('produk.nama as nama_produk');
        $transaksi->where('transaksi.id', $id);
        $transaksi = $transaksi->first();
        if (!$transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(previous_url());
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Order Detail",
            'transaksi' => $transaksi,
        ];
        return view('admin/detail_order', $data);
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
        return view('admin/produk', $data);
    }

    public function log_keuangan()
    {
        $LogSaldo = $this->Log_Saldo->findAll();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Log Keuangan",
            'LogSaldo' => $LogSaldo,
        ];
        return view('admin/keuangan', $data);
    }

    public function bendahara()
    {
        helper('group_helper');
        $getuser = $this->MUser;
        $getuser->select('id');
        $getuser->select('email');
        $getuser->select('username');
        $getuser->select('fullname');
        $getuser->select('alamat');
        $alluser = $getuser->findAll();
        $user = [];
        foreach ($alluser as $usr) {
            $u = $usr->toArray();
            $group = $this->Group->where('user_id', $u['id'])->first();
            $idgroup = $group['group_id'];
            $getgroup = getgroup($idgroup);
            if ($getgroup['name'] === 'bendahara') {
                array_push($user, $u);
            }
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Bendahara",
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/bendahara', $data);
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
