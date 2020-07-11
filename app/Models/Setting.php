<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [ 'page_id', 'page_about_us', 'account_email', 'website' ];
    protected $table = 'settings';

    public function page()
    {
      return $this->belongsTo(Page::class);
    }
}
