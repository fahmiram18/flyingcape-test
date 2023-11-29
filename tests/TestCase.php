<?php

namespace Tests;

use App\Models\Classroom;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'testing_db_flyingcape_test';";

        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        $tables = DB::select($sql);

        array_walk($tables, function($table){
            if ($table->TABLE_NAME != 'migrations') {
                DB::table($table->TABLE_NAME)->truncate();
            }
        });

        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

        Artisan::call('db:seed');
    }

    public function login($email, $password)
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('api/login', [
            "email" => $email,
            "password" => $password,
        ]);

        // assert success in json
        $response->assertStatus(201);

        // return token
        return $response->json()['token'];
    }

    public function createClassroom(){
        $classroom = Classroom::create([
            'name' => Str::random(10),
            'teacher_id' => 1,
            'created_by' => 1,
        ]);

        return $classroom;
    }
}
