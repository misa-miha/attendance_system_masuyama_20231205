<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function showClockInPage()
    {
        if (Auth::check()) {
            $userName = Auth::user()->name;
            return view('index',['userName' => $userName]);
        } else {
            return view('login');
        }
    }

    public function showAttendance()
    {
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)
            ->orderBy('attendance_start', 'desc')
            ->get();

        return view('attendance',compact('attendances'));
    }

    public function attendanceStart()
    {
        $user = Auth::user();

        $latestAttendance = Attendance::where('user_id', $user->id)->latest()->first();

        if ($latestAttendance && $latestAttendance->attendance_end === null) {
            return redirect()->back()->with('attendance-start_error', 'すでに出勤打刻がされています');
        }

        if ($latestAttendance && Carbon::parse($latestAttendance->attendance_start)->isSameDay(Carbon::now())) {
            return redirect()->back()->with('attendance-start_error', '本日は既に勤怠登録が完了しています');
        }

        $attendanceStart = Carbon::now();

        $attendance = Attendance::create([
            'user_id' => $user->id,'attendance_start' => $attendanceStart,
        ]);

        return redirect()->back()->with('attendance-start_success', '勤務開始時刻を打刻しました！');
    }

    public function attendanceEnd()
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if( !empty($attendance->attendance_end)) {
            return redirect()->back()->with('attendance-end_error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        $attendance->update([
            'attendance_end' => Carbon::now()
        ]);

        return redirect()->back()->with('attendance-end_success','勤務終了時刻を打刻しました！');
    }

    public function calculateWorkHours()
    {
        if ($this->attendance_start && $this->attendance_end) {
            $startTime = \Carbon\Carbon::parse($this->attendance_start);
            $endTime = \Carbon\Carbon::parse($this->attendance_end);

            $diffInHours = $endTime->diffInHours($startTime);
            $diffInMinutes = $endTime->diffInMinutes($startTime) % 60;

            return "{$diffInHours}時間{$diffInMinutes}分";
        }

        return '未計測';
    }

    public function checkMidnight()
    {
        $user = Auth::user();

        $now = Carbon::now();

        $latestAttendance = Attendance::where('user_id', $user->id)->latest()->first();

        if ($latestAttendance) {
            $latestWorkStart= new Carbon($latestAttendance->attendance_start);
            $nextDayStart =
            $latestWorkStart->copy()->addDay()->startOfDay();

            if($now->eq($nextDayStart)) {
                if($latestAttendance->attendance_end === null) {
                    $latestAttendance->update([
                    'attendance_end' =>  $nextDayStart,
                ]);

                    Attendance::create([
                        'user_id' => $user->id,
                        'attendance_start' => $nextDayStart,
                    ]);
                }

                elseif($latestAttendance->break_end === null) {
                    $latestAttendance->update([
                        'break_end' => $nextDayStart,
                        'attendance_end' => $nextDayStart,
                    ]);

                    Attendance::create([
                        'user_id' => $user->id,
                        'attendance_start' =>  $nextDayStart,
                        'break_start' =>  $nextDayStart,
                    ]);
                }
            }
        }
    }
}
