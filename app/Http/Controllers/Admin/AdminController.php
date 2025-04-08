<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function LoginAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only(['name','password'])))
        {
            $request->session()->regenerate();
            return redirect()->route('main')->with('success','Login Successfully');
        }
        else
        {
            return redirect()->route('login')->with('error','Admin not found');
        }
    }

    public function LogoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Logout Successully');
    }
}
