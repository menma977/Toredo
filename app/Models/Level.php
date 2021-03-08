<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
  use HasFactory, UuidProvider;

  protected $keyType = "string";

  protected $fillable = [
    'name',
    'type',
    'socket',
    'share',
  ];

  protected $hidden = [
    'id',
  ];
}
