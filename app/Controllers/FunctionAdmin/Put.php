<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Put extends BaseController
{
    public function index()
    {
        return "Cari apa bro?";
    }

    public function user($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $username = $user['username'];
        $fixpass = \Myth\Auth\Password::hash($username);

        $data = [
            "id" => $id,
            "password_hash" => $fixpass,
        ];

        $this->User->save($data);
        session()->setFlashdata('pesan', "Berhasil mereset password $email");
        return redirect()->to(base_url('/user'));
    }

    public function bendahara($id = 0)
    {
        if ($id < 1) {
            return redirect()->to(base_url());
        }
        $user = $this->User->where('id', $id)->first();
        $email = $user['email'];
        $username = $user['username'];
        $fixpass = \Myth\Auth\Password::hash($username);

        $data = [
            "id" => $id,
            "password_hash" => $fixpass,
        ];

        $this->User->save($data);
        session()->setFlashdata('pesan', "Berhasil mereset password $email");
        return redirect()->to(base_url('/bendahara'));
    }
}
