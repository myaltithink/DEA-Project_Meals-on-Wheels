<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaregiverDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_member_name',
        'assigned_member_email'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'caregiver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
