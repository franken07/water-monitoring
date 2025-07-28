<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['date', 'start_time','end_time', 'admin_name','email','phone','user_id','image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
