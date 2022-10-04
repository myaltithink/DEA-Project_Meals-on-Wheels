<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
