<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ 'page_id', 'post_id', 'description', 'is_deleted', 'deleted_at', 'published_at' ];
    protected $table = 'posts';

    public function keywords()
    {
      return $this->hasMany(Keyword::class);
    }

    public function page()
    {
      return $this->belongsTo(Page::class);
    }
}
