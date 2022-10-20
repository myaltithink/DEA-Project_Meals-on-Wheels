<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedUsers extends Model
{
    use HasFactory;

    protected $table = 'rejected_users';

    protected $fillable = [
        'email',
        'reason_of_rejection'
    ];
}
