@extends('layouts.parent')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_registration.css') }}" />
@endsection

@section('content')
    <main>
        <div class="user-registration__content">
            <div class="user-registration__heading">
                <h2>会員登録</h2>
            </div>
            <form class="user-registration__form" action="{{ route('register')}}" method="post">
            @csrf
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" />
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation" placeholder="確認用パスワード" value="{{ old('password_confirmation') }}" />
                    </div>
                    <div class="form__error">
                        @error('password_confirmation')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">会員登録</button>
                </div>
            </form>
            <div class="login__group">
                <p class="login__text">
                    アカウントをお持ちの方はこちら
                </p>
                <a class="login__button" href="{{ route('login')}}">ログイン</a>
            </div>
        </div>
    </main>
@endsection