<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('catalog');
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
}
