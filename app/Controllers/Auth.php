<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

    public function cekrole()
    {
        if (!user()) {
            return redirect()->to(base_url('login'));
        } else {
            $role = array_values(user()->getRoles())[0];
            switch ($role) {
                case 'admin':
                    return redirect()->to(base_url('admin-dashboard'));
                    break;
                case 'bendahara':
                    return redirect()->to(base_url('bendahara-dashboard'));
                    break;

                default:
                    return redirect()->to(base_url('user-dashboard'));
                    break;
            }
        }
    }
}
