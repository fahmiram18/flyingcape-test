<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::updateOrCreate(
            [ 'id' => 1],
            [
                'firstname' => 'Jimmy',
                'surname' => 'Doe',
            ]);

        User::create([
            'username' => 'jimmydoe',
            'email' => 'jimmydoe@mail.com',
            'password' => Hash::make('student123'),
            'role_id' => 3,
            'parent_id' => 1
        ]);
    }
}
