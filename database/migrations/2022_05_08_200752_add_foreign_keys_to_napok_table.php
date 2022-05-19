<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNapokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('napok', function (Blueprint $table) {
            $table->foreign(['ID_tabor'], 'napok_ibfk_1')->references(['ID'])->on('tabor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('napok', function (Blueprint $table) {
            $table->dropForeign('napok_ibfk_1');
        });
    }
}
