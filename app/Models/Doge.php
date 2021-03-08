<?php

namespace App\Models;

use App\Providers\UuidProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doge extends Model
{
  use HasFactory, UuidProvider;

  protected $keyType = "string";

  protected $fillable = [
    'username',
    'wallet',
    'cookie',
  ];

  protected $hidden = [
    'id',
    'user_id',
    'password',
  ];

  /**
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}
