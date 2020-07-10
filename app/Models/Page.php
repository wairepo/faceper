<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [ 'user_id', 'page_id', 'name', 'category', 'is_deleted', 'deleted_at' ];
    protected $table = 'pages';

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
