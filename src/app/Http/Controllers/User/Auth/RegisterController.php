<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    // 状況次第でこの宣言があるとエラーになる
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('user');
    }

    // 新規登録画面
    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    // バリデーション
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    // 仮登録処理
    protected function temporaryRegister(){
        // ここに仮登録機能を実装

        // 仮登録したユーザに本登録メールを送信
        //      そのメール内に本登録用リンク(?email="登録したユーザのメールアドレスを記載しておく"
        // usersテーブルに仮登録ユーザを登録(temporary_registeredカラム = "1")
        // 仮登録完了ページを表示(resources/views/temporary_registered.blade.php)

    }

    // 登録処理
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // 現在時間 $today=Carbon::now();
        // 有効期限(秒) $valid_limit = 300;
        // 1) 現在時間 - 仮登録時時間 < 有効期限(秒)なら
        //      temporary_registeredカラム = "0"とする
        //      本登録完了ページを表示(resources/views/thanks.blade.php)
        // 2) 現在時間 - 仮登録時時間 > 有効期限(秒)なら
        //      再登録要請ページを表示(resources/views/retry_register.blade.php)
        //      仮登録したユーザをusersテーブルから削除
    }

    // リダイレクト
    protected function redirectTo()
    {
        return '/thanks';
    }
}
