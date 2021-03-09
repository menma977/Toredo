<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'price',
    ];

    protected $hidden = [
        'id',
    ];
}
