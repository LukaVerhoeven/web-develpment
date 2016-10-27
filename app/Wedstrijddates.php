<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wedstrijddates extends Model
{
  protected $fillable = [
      'price', 'startdate', 'enddate',
  ];
}
