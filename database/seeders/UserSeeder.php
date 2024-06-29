<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => 'password',
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => 'password',
                'role_id' => $userRole->id,
            ],
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
