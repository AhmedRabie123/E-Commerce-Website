<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $user_type = Auth::user()->usertype;

        if($user_type == '1'){
          return view('Admin.home');
        }else{
            return view('dashboard');
        }
    }
}
