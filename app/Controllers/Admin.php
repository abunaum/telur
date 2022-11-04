<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'judul' => "Admin | $this->namaweb"
        ];
        return view('admin/index', $data);
    }

    public function user()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'judul' => "Admin | $this->namaweb"
        ];
        return view('admin/index', $data);
    }

    public function transaksi()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'judul' => "Admin | $this->namaweb"
        ];
        return view('admin/index', $data);
    }

    public function bendahara()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'judul' => "Admin | $this->namaweb"
        ];
        return view('admin/index', $data);
    }
}
