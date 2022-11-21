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
        $data = [
            'namaweb' => $this->namaweb,
            'halaman' => "Transaksi"
        ];
        return view('admin/index', $data);
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

    public function bendahara()
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
