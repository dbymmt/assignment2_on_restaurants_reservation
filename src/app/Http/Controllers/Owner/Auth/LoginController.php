<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 状況次第でこの宣言があるとエラーになる
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::OWNER_HOME;

    public function __construct()
    {
        $this->middleware('guest:owner')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('owner');
    }

    public function showLoginForm()
    {
        return view('owner.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('owner')->logout();

        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {
        return redirect(route('owner.login'));
    }
}
