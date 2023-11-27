<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'teachers';
    protected $fillable = [
        'firstname',
        'surname',
        'expertise',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function classroom()
    {
        return $this->hasMany(Classroom::class, 'teacher_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'parent_id', 'id');
    }
}
