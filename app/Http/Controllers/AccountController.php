<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class AccountController extends Controller
{
  protected function test(array $data)
  {
      return User::create([
          'firstname' => $data['firstname'],
          'lastname' => $data['lastename'],
          'email' => $data['email'],
          'ip' => Request::ip(),
          'password' => bcrypt($data['password']),
      ]);
  }
}
