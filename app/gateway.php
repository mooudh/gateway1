<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gateway extends Model
{
  protected $fillable =['bank','username','password','terminalId','callback_url'];
}
