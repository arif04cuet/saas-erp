<?php

namespace Database\Seeders;

use App\Entities\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('admin123'),
            'remember_token' => NULL,
            'created_at' => '2020-02-25 16:35:02',
            'updated_at' => '2020-02-25 16:35:02',
            'username' => 'superadmin',
            'user_type' => 'Employee',
            'mobile' => '01732609096',
            'reference_table_id' => 1,
            'status' => 'Active',
            'deleted_at' => NULL,
            'last_password_change' => NULL,
        ];

        User::updateOrCreate(
            ['username' => 'superadmin'],
            $userData
        );
    }
}
