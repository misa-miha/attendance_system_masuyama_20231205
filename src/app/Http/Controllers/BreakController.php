<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use App\Models\BreakTime;

class BreakController extends Controller
{
    public function breakStart()
    {
        $user = Auth::user();

        $latestAttendance = Attendance::where('user_id', $user->id)->latest()->first();


        if ($latestAttendance && $latestAttendance->attendance_start && !$latestAttendance->attendance_end && !$latestAttendance->break_end && !$latestAttendance->break_start) {
            BreakTime::create([
            'attendance_id' =>$latestAttendance->id,
            'break_start' => Carbon::now(),
        ]);

            return redirect()->back()->with('break-start_success', '休憩開始時刻を打刻しました！');
        }
        return redirect()->back()->with('break-start_error', '休憩開始時刻を打刻できませんでした');
    }

    public function breakEnd() {
        $user = Auth::user();

        $latestAttendance = Attendance::where('user_id', $user->id)->latest()->first();

        if (!$latestAttendance) {
        return redirect()->back()->with('break-end_error', '休憩開始時刻を打刻できませんでした');
    }

        $latestBreakStart = BreakTime::where('attendance_id',$latestAttendance->id)->latest()->first();

        if($latestBreakStart->break_start &&
        !$latestBreakStart->break_end) {
            $latestBreakStart->update([
                'break_end' => Carbon::now(),
            ]);
            return redirect()->back()->with('break-end_success', '休憩終了時刻を打刻しました！');
        }

        return redirect()->back()->with('break-start_error', '休憩開始時刻を打刻できませんでした');
    }

    public function calculateBreakTime()
    {
        // Check if both break_start and break_end are set
        if ($this->break_start && $this->break_end) {
            $breakStartTime = \Carbon\Carbon::parse($this->break_start);
            $breakEndTime = \Carbon\Carbon::parse($this->break_end);

            // Calculate the difference in hours and minutes
            $diffInHours = $breakEndTime->diffInHours($breakStartTime);
            $diffInMinutes = $breakEndTime->diffInMinutes($breakStartTime) % 60;

            return "{$diffInHours}時間{$diffInMinutes}分";
        }

        return '未計測';
    }

}

