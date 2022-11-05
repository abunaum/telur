<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Myth\Auth\Password;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'judul' => "Login | $this->namaweb",
            'config' => config('Auth'),
        ];
        return view('login', $data);
    }
}
