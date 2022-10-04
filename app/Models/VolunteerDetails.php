<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_name',
        'volunteer_role',
        'organization_name',
        'organization_address'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'volunteer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
