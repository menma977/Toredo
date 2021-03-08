<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinariesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('binaries', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->unsignedBigInteger("sponsor");
      $table->foreign('sponsor')->references('id')->on('users');
      $table->unsignedBigInteger("down_line");
      $table->foreign('down_line')->references('id')->on('users');
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
    Schema::dropIfExists('binaries');
  }
}
