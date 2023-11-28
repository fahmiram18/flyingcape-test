<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        admin permission

        RolePermission::updateOrCreate(
            ['id' => 1],
            [
                'role_id' => '1',
                'prefix' => 'api/classroom',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );

        RolePermission::updateOrCreate(
            ['id' => 2],
            [
                'role_id' => '1',
                'prefix' => 'api/teacher',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );

        RolePermission::updateOrCreate(
            ['id' => 3],
            [
                'role_id' => '1',
                'prefix' => 'api/student',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );

//        Teacher permission

        RolePermission::updateOrCreate(
            ['id' => 4],
            [
                'role_id' => '2',
                'prefix' => 'api/classroom',
                'create' => 0,
                'read' => 1,
                'update' => 0,
                'delete' => 0,
            ]
        );

        RolePermission::updateOrCreate(
            ['id' => 5],
            [
                'role_id' => '2',
                'prefix' => 'api/topic',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );

        RolePermission::updateOrCreate(
            ['id' => 6],
            [
                'role_id' => '2',
                'prefix' => 'api/comment',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );

//        Student Permission

        RolePermission::updateOrCreate(
            ['id' => 7],
            [
                'role_id' => '3',
                'prefix' => 'api/topic',
                'create' => 0,
                'read' => 1,
                'update' => 0,
                'delete' => 0,
            ]
        );

        RolePermission::updateOrCreate(
            ['id' => 8],
            [
                'role_id' => '3',
                'prefix' => 'api/comment',
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        );
    }
}
