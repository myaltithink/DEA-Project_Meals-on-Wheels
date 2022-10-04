<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'individual_profile';

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'gender',
        'birthday',
        'contact_number',
        'address',
        'valid_id'
    ];


    public function member_details()
    {
        return $this->belongsTo(MemberDetails::class, 'member_id');
    }

    public function caregiver_details()
    {
        return $this->belongsTo(CaregiverDetails::class, 'caregiver_id');
    }

    public function volunteer_details()
    {
        return $this->belongsTo(VolunteerDetails::class, 'volunteer_id');
    }
}
