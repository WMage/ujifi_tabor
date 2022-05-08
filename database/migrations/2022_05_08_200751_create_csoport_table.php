<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsoportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csoport', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('nev');
            $table->integer('ID_vezeto1')->nullable()->index('ID_vezeto1');
            $table->integer('ID_vezeto2')->nullable()->index('ID_vezeto2');
            $table->string('hely')->nullable();
            $table->integer('ID_tabor')->index('ID_tabor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csoport');
    }
}
