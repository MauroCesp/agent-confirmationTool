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
        Schema::create('journals', function (Blueprint $table) {
              $table->increments('id');
              $table->string('cust_group');
              $table->string('shortName');
              $table->string('orderNumber');
              $table->string('vendor')->nullable();
              $table->string('issn')->nullable();
              $table->string('title')->nullable();
              $table->string('publisher')->nullable();
              $table->string('productClass');
              $table->string('jumpStart')->nullable();
              $table->string('startCoverage')->nullable();
              $table->string('endCoverage')->nullable();
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
        Schema::dropIfExists('journals');
    }
};
