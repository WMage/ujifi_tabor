<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpuletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epulet', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('megnevezes')->nullable();
            $table->string('utca_hsz')->nullable();
            $table->smallInteger('irszam')->nullable();
            $table->string('lakokneme', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epulet');
    }
}
