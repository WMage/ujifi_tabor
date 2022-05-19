<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJelenetkezoDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jelenetkezo_dieta', function (Blueprint $table) {
            $table->integer('ID_dieta');
            $table->integer('ID_jelentkezo')->index('jelenetkezo_dieta_ibfk_2');

            $table->unique(['ID_dieta', 'ID_jelentkezo'], 'ID_dieta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jelenetkezo_dieta');
    }
}
