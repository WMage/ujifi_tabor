<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeallitasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beallitasok', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->string('kulcs',50)->nullable();
            $table->string('ertek',255)->nullable();
            $table->string('tabla',50)->nullable();

            $table->unique(['kulcs', 'tabla'], 'kulcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beallitasok');
    }
}
