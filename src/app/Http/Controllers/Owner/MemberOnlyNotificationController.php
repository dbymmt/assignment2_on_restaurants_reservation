<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Notification\MemberOnlyNotification;
use Illuminate\Http\Request;

class MemberOnlyNotificationController extends Controller
{
    //
    public function index()
    {
        return view('owner.notification');
    }

    public function sendMail(Request $request)
    {
        $users = User::where('email_accepted', true)->get();

        foreach ($users as $user) {
            $user->notify(new MemberOnlyNotification($user));
        }

        return back()->with('message', 'メールを送信しました');
    }
}
