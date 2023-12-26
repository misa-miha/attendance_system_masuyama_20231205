@extends('layouts.parent')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
    <main>
        <div class="login__content">
            <div class="login__heading">
                <h2>ログイン</h2>
            </div>
            <form class="login-form" action="{{ route('login')}}" method="post">
            @csrf
                <div class="login-form__group">
                    <div class="login-form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" />
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="login-form__group">
                    <div class="login-form__input--text">
                        <input type="password" name="password" placeholder="パスワード" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="login-form__button">
                    <button class="login-form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
            <div class="user-registration__group">
                <p class="user-registration__text">
                    アカウントをお持ちでない方はこちらから
                </p>
                <a class="user-registration__button" href="{{ route('register')}}">会員登録</a>
            </div>
        </div>
    </main>
@endsection