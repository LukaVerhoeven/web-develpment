<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wedstrijddate extends Model
{
  protected $fillable = [
      'price', 'startdate', 'enddate',
  ];
}
