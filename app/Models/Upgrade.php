<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    use HasFactory, UuidProvider;

    protected $keyType = "string";

    protected $fillable = [
        'debit',
        'credit',
    ];

    protected $hidden = [
        'id',
        'user_id',
    ];
}
