<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::updateOrCreate(
            [ 'id' => 1],
            [
                'firstname' => 'John',
                'surname' => 'Doe',
                'expertise' => 'Programming',
            ]);

        User::create([
            'username' => 'johndoe',
            'email' => 'johndoe@mail.com',
            'password' => Hash::make('teacher123'),
            'role_id' => 2,
            'parent_id' => 1
        ]);
    }
}
