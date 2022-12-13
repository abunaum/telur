<?php

namespace App\Controllers\FunctionBendahara;

use App\Controllers\BaseController;

class Post extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function cekkode($kode = null)
    {
        if (!$kode) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(previous_url());
        }
        $transaksi = $this->Transaksi->where('kode', $kode)->first();
        if (!$transaksi) {
            session()->setFlashdata('error', 'Transaksi tidak valid');
            return redirect()->to(previous_url());
        } else {
            return redirect()->to(base_url('transaksi-user/detail/' . $transaksi['id']));
        }
    }

    public function tambah_keuangan()
    {
        $jenis = $this->request->getVar("jenis");
        $nominal = $this->request->getVar("nominal");
        $keterangan = $this->request->getVar("keterangan");
        if (!$this->validate([
            'jenis' => [
                'jenis'  => 'required',
                'errors' => [
                    'required' => 'Jenis harus di isi',
                ]
            ],
            'nominal' => [
                'rules'  => 'required|is_natural',
                'errors' => [
                    'required' => 'Nominal harus di isi',
                    'is_natural' => 'Nominal tidak valid'
                ]
            ],
            'keterangan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Keterangan harus di isi',
                ]
            ],
        ])) {
            session()->setFlashdata('error', 'Gagal menambah data keuangan');
            return redirect()->to(previous_url())->withInput();
        }

        $this->Log_Saldo->insert([
            'jenis' => $jenis,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
        ]);
        session()->setFlashdata('pesan', 'Berhasil menambah data keuangan');
        return redirect()->to(previous_url());
    }
}
