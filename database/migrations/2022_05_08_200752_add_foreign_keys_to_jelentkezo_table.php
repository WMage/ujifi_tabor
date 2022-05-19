<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJelentkezoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelentkezo', function (Blueprint $table) {
            $table->foreign(['ID_aszf'], 'jel_aszf')->references(['ID'])->on('aszf')->onUpdate('CASCADE');
            $table->foreign(['MOD_user'], 'jelentkezo_ibfk_1')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['ID_tabor'], 'jel_tabor')->references(['ID'])->on('tabor')->onUpdate('CASCADE');
            $table->foreign(['ID_csoport'], 'jelentkezo_ibfk_2')->references(['ID'])->on('csoport')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jelentkezo', function (Blueprint $table) {
            $table->dropForeign('jel_aszf');
            $table->dropForeign('jelentkezo_ibfk_1');
            $table->dropForeign('jel_tabor');
            $table->dropForeign('jelentkezo_ibfk_2');
        });
    }
}
