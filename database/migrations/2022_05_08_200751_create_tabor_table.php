<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaborTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabor', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('motto')->nullable();
            $table->integer('ID_aszf')->nullable()->index('tabor_aszf');
            $table->string('varos')->nullable();
            $table->string('cim')->nullable();
            $table->integer('ferohely')->nullable();
            $table->integer('kor_min')->nullable();
            $table->integer('kor_max')->nullable();
            $table->dateTime('REG_start')->nullable();
            $table->dateTime('REG_end')->nullable();
            $table->dateTime('DATE_creation')->nullable();
            $table->dateTime('DATE_lastmod')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabor');
    }
}
