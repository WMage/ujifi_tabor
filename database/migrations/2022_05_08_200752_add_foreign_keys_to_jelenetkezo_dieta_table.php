<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJelentkezoDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelentkezo_dieta', function (Blueprint $table) {
            $table->foreign(['ID_dieta'], 'jelentkezo_dieta_ibfk_1')->references(['ID'])->on('dieta')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['ID_jelentkezo'], 'jelentkezo_dieta_jdfk_2')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jelentkezo_dieta', function (Blueprint $table) {
            $table->dropForeign('jelentkezo_dieta_ibfk_1');
            $table->dropForeign('jelentkezo_dieta_jdfk_2');
        });
    }
}
