<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'role_description'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id');
    }

    public function findByName(string $role_name){
        return $this->where('role_name', $role_name);
    }
}
