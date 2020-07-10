<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model
{
  protected $fillable = ['user_id', 'provider_user_id', 'provider'];
  protected $table = 'facebook_accounts';

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
