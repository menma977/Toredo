<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binary extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor',
        'down_line',
    ];

    protected $hidden = [
        'id',
    ];
}
