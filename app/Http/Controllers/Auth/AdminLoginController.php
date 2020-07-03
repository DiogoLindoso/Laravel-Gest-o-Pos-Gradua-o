<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function login(Request $resquest){
        $this->validate($resquest,[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $resquest->email,
            'password' => $resquest->password
        ];
        $authOK = Auth::guard('admin')->attempt($credentials, $resquest->remember);
        
        if($authOK){
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($resquest->only('email','remember'));
    }
    public function index(){
        return view("auth.admin-login");
    }
}
