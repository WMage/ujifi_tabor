<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJelentkezoNapokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jelentkezo_napok', function (Blueprint $table) {
            $table->foreign(['ID_jelentkezo'], 'jelentkezo_napok_ibfk_1')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['ID_napok'], 'jelentkezo_napok_ibfk_2')->references(['ID'])->on('napok')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jelentkezo_napok', function (Blueprint $table) {
            $table->dropForeign('jelentkezo_napok_ibfk_1');
            $table->dropForeign('jelentkezo_napok_ibfk_2');
        });
    }
}
