<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [ 'user_id', 'page_id', 'role' ];
    protected $table = 'roles';

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function page()
    {
      return $this->belongsTo(Page::class);
    }
}
