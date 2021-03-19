<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLimit extends Model
{
    use HasFactory, UuidProvider;

    protected $keyType = "string";

    protected $fillable = [
        'min',
        'max',
        'value',
    ];

    protected $hidden = [
        'id',
    ];
}
