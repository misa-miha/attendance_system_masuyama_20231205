<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    protected $table = 'breaks';
    protected $guarded = array('id');
    public static $rules = array(
        'attendance_id' => 'required',
    );

    public function attendance()
    {
        return $this->belongsTo(Attendance::class,'attendance_id', 'id');
    }
}
