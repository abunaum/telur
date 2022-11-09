<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        if (user()) {
            return redirect()->to(base_url());
        } else {

            $data = [
                'namaweb' => $this->namaweb,
                'judul' => "Login | $this->namaweb",
                'config' => config('Auth'),
            ];
            return view('login', $data);
        }
    }

    public function cekrole()
    {
        helper('group_helper');
        if (!user()) {
            return redirect()->to(base_url('login'));
        } else {
            $group = $this->Group->where('user_id', user()->id)->first();
            $idgroup = $group['group_id'];
            $getgroup = getgroup($idgroup);
            $groupname = $getgroup['name'];
            switch ($groupname) {
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
