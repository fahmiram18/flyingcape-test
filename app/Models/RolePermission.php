<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "role_permissions";

    protected $fillable = [
        'role_id',
        'prefix',
        'create',
        'read',
        'update',
        'delete',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
