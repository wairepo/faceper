<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [ 'page_id', 'token', 'name', 'category', 'is_deleted', 'deleted_at' ];
    protected $table = 'pages';

    public function users()
    {
      return $this->belongsToMany(User::class, 'role', 'page_id', 'user_id');
    }

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    public function setting()
    {
      return $this->hasOne(Setting::class);
    }

    public function locations()
    {
      return $this->hasMany(Location::class);
    }
}
