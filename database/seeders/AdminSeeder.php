<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->fill([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '0.0',
            'latitude' => '0.0',
            'status' => 'REGISTERED'
        ])->save();

        $user->roles()->attach(Role::where('role_name', 'ROLE_ADMIN')->get()[0]);
    }
}
