<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTaborTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabor', function (Blueprint $table) {
            $table->foreign(['ID_aszf'], 'tabor_aszf')->references(['ID'])->on('aszf')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabor', function (Blueprint $table) {
            $table->dropForeign('tabor_aszf');
        });
    }
}
