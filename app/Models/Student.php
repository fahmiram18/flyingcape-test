<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'firstname',
        'surname',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
//        return User::where(['role_id' => 3, 'parent_id' => $this->user()->id])->first();
//        return $this->hasOne(User::class, 'parent_id', 'id');
    }
}
