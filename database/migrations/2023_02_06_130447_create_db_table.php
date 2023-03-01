<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('db', function (Blueprint $table) {
          $table->increments('id');
          $table->string('cust_group');
          $table->string('shortName')->nullable();
          $table->string('orderNumber');
          $table->string('vendor');
          $table->string('formatShortName')->nullable();
          $table->string('productClass');
          $table->string('title')->nullable();
          $table->string('jumpStart')->nullable();
          $table->string('publisher')->nullable();
          $table->dateTime('created_at', $precision = 0);
          $table->dateTime('updated_at', $precision = 0);
          $table->engine = 'InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_unicode_ci';

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db');
    }
};
