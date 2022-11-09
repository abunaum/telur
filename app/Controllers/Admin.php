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
        return view('admin/index', $data);
    }

    public function user()
    {
        helper('group_helper');
        $getuser = $this->MUser;
        $getuser->select('id');
        $getuser->select('email');
        $getuser->select('username');
        $getuser->select('fullname');
        $alluser = $getuser->findAll();
        $user = [];
        foreach ($alluser as $usr) {
            $u = $usr->toArray();
            $group = $this->Group->where('user_id', $u['id'])->first();
            $idgroup = $group['group_id'];
            $getgroup = getgroup($idgroup);
            $fixusr = array_merge($u, ['group' => $getgroup]);

            array_push($user, $fixusr);
        }
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "User",
            'user' => $user
        ];
        return view('admin/user', $data);
    }

    public function tambah_user()
    {
        echo "user";
    }

    public function transaksi()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Transaksi"
        ];
        return view('admin/index', $data);
    }

    public function bendahara()
    {
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Bendahara"
        ];
        return view('admin/index', $data);
    }
}
