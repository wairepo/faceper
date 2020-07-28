<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [ 'permission', 'is_published' ];
    protected $table = 'permissions';
}
