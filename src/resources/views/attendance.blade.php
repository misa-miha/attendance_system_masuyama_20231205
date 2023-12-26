@extends('layouts.parent')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
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
        <div class="attendance-record__content">
            <div class="attendance-recode__date">
                <button onclick="previousDay()"><</button>
                <span id="currentDate">
                    @if($attendances->isNotEmpty())
                    {{ \Carbon\Carbon::parse($attendances->first()->attendance_start)->format('Y-m-d') }}
                    @endif
                </span>
                <button onclick="nextDay()">></button>
            </div>
            <div class="attendance-record__table">
                <table class="attendance-record__table__inner">
                    <tr class="attendance-record__table__row">
                        <th class="attendance-record__table__header">名前</th>
                        <th class="attendance-record__table__header">勤務開始</th>
                        <th class="attendance-record__table__header">勤務終了</th>
                        <th class="attendance-record__table__header">休憩時間</th>
                        <th class="attendance-record__table__header">勤務時間</th>
                    </tr>
                    <tr class="attendance-record__table__row">
                        <td class="attendance-record__table__name">
                            @if($attendances->isNotEmpty())
                            {{ $attendances->first()->user->name }}
                            @endif
                        </td>
                        <td class="attendance-record__table__work-start">
                            @foreach ($attendances as $attendance)
                            <div>{{ \Carbon\Carbon::parse($attendance->attendance_start)->format('H:i:s') }}</div>
                            @endforeach
                        </td>
                        <td class="attendance-record__table__work-end">
                            @foreach ($attendances as $attendance)
                            <div>{{ \Carbon\Carbon::parse($attendance->attendance_end) ->format('H:i:s') }}</div>
                            @endforeach
                        </td>
                        <td class="attendance-record__table__break-time">
                        </td>
                        <td class="attendance-record__table__work-time"></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
@endsection