<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJelenetkezoDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelenetkezo_dieta', function (Blueprint $table) {
            $table->foreign(['ID_dieta'], 'jelenetkezo_dieta_ibfk_1')->references(['ID'])->on('dieta')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['ID_jelentkezo'], 'jelenetkezo_dieta_ibfk_2')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jelenetkezo_dieta', function (Blueprint $table) {
            $table->dropForeign('jelenetkezo_dieta_ibfk_1');
            $table->dropForeign('jelenetkezo_dieta_ibfk_2');
        });
    }
}
