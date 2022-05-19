<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJelentkezoSegitomunkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelentkezo_segitomunka', function (Blueprint $table) {
            $table->foreign(['ID_jelentkezo'], 'jelentkezo_segitomunka_ibfk_1')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE');
            $table->foreign(['ID_segito_munka'], 'jelentkezo_segitomunka_ibfk_2')->references(['ID'])->on('segitomunka')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jelentkezo_segitomunka', function (Blueprint $table) {
            $table->dropForeign('jelentkezo_segitomunka_ibfk_1');
            $table->dropForeign('jelentkezo_segitomunka_ibfk_2');
        });
    }
}
