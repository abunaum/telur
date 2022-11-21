<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Bendahara extends BaseController
{
    public function index()
    {
        return "cari apa bos ?";
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
