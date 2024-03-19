<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Notifications\MemberOnlyNotification;
use Illuminate\Http\Request;
use App\Models\User;

class MemberOnlyNotificationController extends Controller
{
    //
    public function index()
    {
        return view('owner.template');
    }

    public function sendMail(Request $request)
    {
        $mailTemplate = $request->input('mail_template');
        $users = User::where('mail_accepting', 1)->get();

        foreach ($users as $user) {
            $user->notify(new MemberOnlyNotification($user, $mailTemplate));
        }

        return back()->with('message', 'メールを送信しました');
    }
}
