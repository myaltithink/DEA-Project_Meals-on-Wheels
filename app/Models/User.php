<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'longtitude',
        'latitude',
        'details_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function member_details()
    {
        return $this->hasOne(MemberDetails::class, 'user_id');
    }

    public function caregiver_details()
    {
        return $this->hasOne(CaregiverDetails::class, 'user_id');
    }

    public function partner_details()
    {
        return $this->hasOne(PartnerDetails::class, 'user_id');
    }

    public function volunteer_details()
    {
        return $this->hasOne(VolunteerDetails::class, 'user_id');
    }



    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
}
