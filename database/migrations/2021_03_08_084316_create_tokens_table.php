<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::create('tokens', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->unsignedBigInteger("user_id");
      $table->foreign('user_id')->references('id')->on('users');
      $table->double("debit")->default(0.0);
      $table->double("credit")->default(0.0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(): void
  {
    Schema::dropIfExists('tokens');
  }
}
