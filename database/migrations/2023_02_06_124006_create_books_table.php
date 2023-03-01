<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// https://laravel.com/docs/9.x/migrations#creating-tables
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cust_group');
            $table->string('shortName');
            $table->string('orderNumber');
            $table->string('vendor');
            $table->string('isbn');
            $table->string('title');
            $table->string('edition');
            $table->string('productClass');
            $table->string('jumpStart');
            $table->string('publisher');
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
        Schema::dropIfExists('books');
    }
};
