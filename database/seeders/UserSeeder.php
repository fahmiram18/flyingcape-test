<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['id' => 1],
            [
                'username' => 'admin',
                'role_id' => 1,
                'parent_id' => null,
                'email' => 'admin@flyingcape.com.sg',
                'password' => Hash::make('admin123'),
            ]
        );

        $user->createToken('admintoken')->plainTextToken;
    }
}
