<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySetting extends Model
{
  use HasFactory;

  protected $fillable = [
    'switch',
  ];

  protected $hidden = [
    'id',
  ];
}
