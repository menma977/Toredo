<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  use HasFactory;

  protected $fillable = [
    'username',
    'wallet',
    'cookie',
  ];

  protected $hidden = [
    'id',
    'password',
  ];
}
