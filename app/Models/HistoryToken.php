<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryToken extends Model
{
    use HasFactory, UuidProvider;

    protected $keyType = "string";

    protected $fillable = [
        'description',
        'value',
    ];

    protected $hidden = [
        'id',
        'user_id',
    ];
}
