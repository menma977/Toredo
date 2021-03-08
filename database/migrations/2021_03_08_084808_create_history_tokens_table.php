<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTokensTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('history_tokens', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->unsignedBigInteger("user_id");
      $table->foreign('user_id')->references('id')->on('users');
      $table->text("description");
      $table->float("value");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('history_tokens');
  }
}
