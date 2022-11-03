<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // helper('filesystem');
        return view('welcome_message');
        // $test = array('aaa' => 'aaa', 'bbb' => "bbb");
        // $route = file_get_contents(APPPATH . "Utils/Routes-Get.json");
        // $rout = json_decode($route, TRUE);
        // // echo $route[0]["url"];
        // dd($rout);
    }
}
