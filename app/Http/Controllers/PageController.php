<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function enter()
    {

      return view('enter');

    }
/*
    public function login()
    {
      return view('auth.login', [
        'first' => 'test';
      ]);
    }
    */
}
