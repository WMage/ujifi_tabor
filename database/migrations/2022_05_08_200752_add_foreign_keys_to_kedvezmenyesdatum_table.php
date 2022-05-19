<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKedvezmenyesdatumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kedvezmenyesdatum', function (Blueprint $table) {
            $table->foreign(['ID_tabor'], 'kedvezmenyesdatum_ibfk_1')->references(['ID'])->on('tabor')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kedvezmenyesdatum', function (Blueprint $table) {
            $table->dropForeign('kedvezmenyesdatum_ibfk_1');
        });
    }
}
