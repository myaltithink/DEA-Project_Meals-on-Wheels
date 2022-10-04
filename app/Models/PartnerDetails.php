<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'partner_id';
    protected $fillable = [
        'partner_name',
        'partner_registered_by',
        'partner_address',
        'partner_business_license'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
