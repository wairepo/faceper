<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [ 'post_id', 'name', 'is_free_shipping', 'published_at', 'expired_at', 'is_deleted', 'deleted_at', 'is_inventory', 'inventory' ];
    protected $table = 'keywords';

    public function post()
    {
      return $this->belongsTo(Post::class);
    }
}
