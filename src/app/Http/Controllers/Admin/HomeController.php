<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $owners = Owner::all();
        $users = User::all();

        return view('admin.home', compact('owners', 'users'));
    }

    public function ownerAdd(Request $request)
    {
        $input = $request->except('_token');
        // dd($input);

        $new_owner = Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // dd($new_owner);

        return redirect()->route('admin.home');
    }
}
