<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $prefix = 'ROLE_';

        DB::table('roles')->insert([
            'role_name' => $prefix . 'ADMIN',
            'role_description' => 'administrator of the Meals on Wheels web application'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'MEMBER',
            'role_description' => 'the metioned people who are not able to keep a good nutritonal status and need of an assistance'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'CAREGIVER',
            'role_description' => 'users who are wiling to take care of a member be it their relative or not'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'PARTNER',
            'role_description' => 'companies/organizations who are willing to lend a hand to MerryMeals'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'VOLUNTEER',
            'role_description' => 'individuals or organizations(could not register as a partner) who are willing to lend a hand to MerryMeals'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'VOLUNTEER_COOK',
            'role_description' => 'individuals or organizations(could not register as a partner) who registered as a volunteer and chose to be a outsource kitchen'
        ]);

        DB::table('roles')->insert([
            'role_name' => $prefix . 'VOLUNTEER_RIDER',
            'role_description' => 'individuals or organizations(could not register as a partner) who registered as a volunteer and chose to be a rider'
        ]);


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
