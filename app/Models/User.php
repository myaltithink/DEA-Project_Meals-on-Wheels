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

    protected $primaryKey = 'user_id';

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
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id');
    }

    public function hasRoles($role)
    {
        if (is_array($role)) {
            foreach ($role as $rolecheck) {
                if (!$this->hasPermission($rolecheck)) {
                    return false;
                }
            }
        } else {
            if (!$this->hasPermission($role)) {
                return false;
            }
        }
        return true;
    }

    public function hasAnyRole($role)
    {
        if (is_array($role)) {
            foreach ($role as $rolecheck) {
                if ($this->hasPermission($rolecheck)) {
                    return true;
                }
            }
        } else {
            if ($this->hasPermission($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission(string $role)
    {
        if ($this->roles()->where('role_name', $role)->first() != null) {
            return true;
        } else {
            return false;
        }
    }
}
