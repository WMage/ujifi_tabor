<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTaborarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taborar', function (Blueprint $table) {
            $table->foreign(['ID_kor'], 'taborar_ibfk_1')->references(['ID'])->on('korsav')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['ID_tabor'], 'taborar_ibfk_3')->references(['ID'])->on('tabor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['ID_kedvdatum'], 'taborar_ibfk_2')->references(['ID'])->on('kedvezmenyesdatum')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taborar', function (Blueprint $table) {
            $table->dropForeign('taborar_ibfk_1');
            $table->dropForeign('taborar_ibfk_3');
            $table->dropForeign('taborar_ibfk_2');
        });
    }
}
