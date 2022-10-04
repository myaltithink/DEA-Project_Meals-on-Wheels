<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'proof_of_eligebility',
        'needs',
        'allergies',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
