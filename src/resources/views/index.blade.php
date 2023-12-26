@extends('layouts.parent')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('header-content')
    <nav class="header-nav">
        <ul class="header-nav__list">
            <li class="header-nav__item">
                <a href="/">ホーム</a>
            </li>
            <li class="header-nav__item">
                <a href="/attendance">日付一覧</a>
            </li>
            <li class="header-nav__item">
                <a href="{{ route('logout')}}">ログアウト</a>
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <main>
        <div class="attendance-registration__content">
            <div class="attendance-registration__message">
                <p>{{ $userName }}さんお疲れ様です！</p>

                <div class="attendance__alert">
                @if(session('attendance-start_success'))
                <div class="alert-success">
                    {{ session('attendance-start_success') }}
                </div>
                @endif

                @if(session('attendance-start_error'))
                <div class="alert-error">
                    {{ session('attendance-start_error') }}
                </div>
                @endif

                @if(session('attendance-end_success'))
                <div class="alert-success">
                    {{ session('attendance-end_success') }}
                </div>
                @endif

                @if(session('attendance-end_error'))
                <div class="alert-error">
                    {{ session('attendance-end_error') }}
                </div>
                @endif

                @if(session('break-start_success'))
                <div class="alert-success">
                    {{ session('break-start_success') }}
                </div>
                @endif

                @if(session('break-start_error'))
                <div class="alert-error">
                    {{ session('break-start_error') }}
                </div>
                @endif

                @if(session('break-end_success'))
                <div class="alert-success">
                    {{ session('break-end_success') }}
                </div>
                @endif

                @if(session('break-end_error'))
                <div class="alert-error">
                    {{ session('break-end_error') }}
                </div>
                @endif
                </div>
            </div>
            <div class="attendance-registration__group">
                <div class="attendance-registration__work-group">
                    <form class="attendance-registration__item" method="post" action="{{ route('attendanceStart') }}">
                    @csrf
                        <button class="work-start__button" type="submit">勤務開始</button>
                    </form>
                    <form class="attendance-registration__item" method="post" action="{{ route('attendanceEnd') }}">
                    @csrf
                        <button class="work-end__button" type="submit">勤務終了</button>
                    </form>
                </div>
                <div class="attendance-registration__break-group">
                    <form class="attendance-registration__item" method="post" action="{{ route('breakStart') }}">
                    @csrf
                        <button class="break-start__button" type="submit">休憩開始</button>
                    </form>
                    <form class="attendance-registration__item" method="post" action="{{ route('breakEnd' ) }}">
                    @csrf
                        <button class="break-end__button" type="submit">休憩終了</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection