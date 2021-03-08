<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageList extends Model
{
  use HasFactory, UuidProvider;

  protected $keyType = "string";

  protected $fillable = [
    'dollar',
    'doge',
    'token',
  ];

  protected $hidden = [
    'id',
  ];
}
