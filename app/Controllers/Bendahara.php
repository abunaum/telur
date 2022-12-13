<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bendahara extends BaseController
{
    public function index()
    {
        $transaksi = $this->Transaksi;
        $ts = $transaksi->where('status', 3)->countAllResults();
        $tk = $transaksi->where('status', 2)->countAllResults();
        $tp = $transaksi->where('status', 1)->countAllResults();
        $tt = $transaksi->where('status', 0)->countAllResults();
        $LogSaldo = $this->Log_Saldo;
        $clsm = $LogSaldo->where('jenis', 'masuk')->findAll();
        $nlsm = 0;
        foreach ($clsm as $value) {
            $nlsm += $value['nominal'];
        }
        $lsk = $LogSaldo->where('jenis', 'keluar')->findAll();
        $nlsk = 0;
        foreach ($lsk as $value) {
            $nlsk += $value['nominal'];
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Dashboard",
            'ts' => $ts,
            'tk' => $tk,
            'tp' => $tp,
            'tt' => $tt,
            'nlsm' => $nlsm,
            'nlsk' => $nlsk,
        ];
        return view('bendahara/dashboard', $data);
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
            'transaksi' => $transaksi,
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/transaksi', $data);
    }

    public function detailorder($id = 0)
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
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/detail_order', $data);
    }

    public function invoice($kode = 0)
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
        $transaksi->where('transaksi.kode', $kode);
        $transaksi = $transaksi->first();
        if (!$transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(previous_url());
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Invoice",
            'transaksi' => $transaksi,
        ];
        return view('bendahara/invoice', $data);
    }

    public function keuangan()
    {
        $LogSaldo = $this->Log_Saldo->findAll();
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Keuangan",
            'LogSaldo' => $LogSaldo,
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/keuangan', $data);
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
