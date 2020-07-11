<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [ 'page_id', 'address1', 'address2', 'country_name', 'country_code', 'province_name', 'province_code', 'latitude', 'longitude', 'is_primary', 'is_deleted' ];
    protected $table = 'locations';

    public function page()
    {
      return $this->belongsTo(Page::class);
    }
}
