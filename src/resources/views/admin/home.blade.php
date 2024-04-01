@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/home.css') }}">
@endsection

@section('js')
@endsection

@section('content')

<article class="admin-home" id="admin-home">
    <section class="admin-home__owner-form">
        <h2 class="admin-home__owner-form-title">オーナー登録フォーム</h2>
        <dl class="admin-home__owner-form-main">
        <form action="/admin/ownerAdd" method="post">
            @csrf
            @error('name')
                <span class="admin-home__owner-form-error" role="alert">
                    {{ $message }}
                </span>
            @enderror
            <dt class="admin-home__owner-form-name">オーナー名：</dt>
            <dd class="admin-home__owner-form-name">
                <input type="text" name="name">
            </dd>
            @error('email')
                <span class="admin-home__owner-form-error" role="alert">
                    {{ $message }}
                </span>
            @enderror
            <dt class="admin-home__owner-form-email">メールアドレス(ログイン名)：</dt>
            <dd class="admin-home__owner-form-email">
                <input type="text" name="email">
            </dd>
            @error('password')
                <span class="admin-home__owner-form-error" role="alert">
                    {{ $message }}
                </span>
            @enderror
            <dt class="admin-home__owner-form-password">パスワード：</dt>
            <dd class="admin-home__owner-form-password">
                <input type="password" name="password">
            </dd>
            <button id="admin-home__owner-form-submit">送信する</button>
        </form>
        </dl>
    </section>

    <section class="admin-home__owner-lists">
        <h2 class="admin-home__owner-form-title">オーナー一覧</h2>
        <table>
            <thead>
                <tr>
                    <th class="admin-home__owner-lists-property-name">オーナー名</th>
                    <th class="admin-home__owner-lists-property-name">メールアドレス(ログイン名)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($owners as $owner)
                    <tr>
                        <td class="admin-home__owner-lists-property-value">
                            {{$owner->name}}
                        </td>
                        <td class="admin-home__owner-lists-property-value">
                            {{$owner->email}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <section class="admin-home__user-lists">
        <h2 class="admin-home__user-form-title">ユーザー一覧</h2>
        <table>
            <thead>
                <tr>
                    <th class="admin-home__user-lists-property-name">ユーザー名</th>
                    <th class="admin-home__user-lists-property-name">メールアドレス(ログイン名)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="admin-home__user-lists-property-value">
                            {{$user->name}}
                        </td>
                        <td class="admin-home__user-lists-property-value">
                            {{$user->email}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
</article>
@endsection