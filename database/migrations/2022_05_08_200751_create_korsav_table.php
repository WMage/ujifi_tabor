<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKorsavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korsav', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('kor_min')->nullable();
            $table->integer('kor_max')->nullable();
            $table->tinyInteger('nemkell_szallas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('korsav');
    }
}
