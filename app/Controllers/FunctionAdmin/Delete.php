<?php

namespace App\Controllers\FunctionAdmin;

use App\Controllers\BaseController;

class Delete extends BaseController
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
        $this->User->delete($id);
        session()->setFlashdata('pesan', "Berhasil menghapus $email");
        return redirect()->to(base_url('/user'));
    }
}
