<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJelentkezoDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jelentkezo_dieta', function (Blueprint $table) {
            $table->integer('ID_dieta');
            $table->integer('ID_jelentkezo')->index('jelentkezo_dieta_ibfk_2');

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
        Schema::dropIfExists('jelentkezo_dieta');
    }
}
