<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [ 'post_id', 'name', 'shipping_fee', 'published_at', 'expired_at', 'is_deleted', 'deleted_at' ];
    protected $table = 'keywords';

    public function post()
    {
      return $this->belongsTo(Post::class);
    }
}
