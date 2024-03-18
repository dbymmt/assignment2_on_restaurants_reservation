<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationExitController extends Controller
{
    //
    public function exitMail(Request $request)
    {
        $user = User::where('email', $request->user_mail)->first();

        if ($user) {
            $user->email_accepted = false;
            $user->save();
        }

        return view('exited');
    }
}
