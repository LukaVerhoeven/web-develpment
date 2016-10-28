<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
  public function wedstrijddate()
  {
    return $this->belongsTo('App\wedstrijddate','wedstrijd_id');
  }
}
