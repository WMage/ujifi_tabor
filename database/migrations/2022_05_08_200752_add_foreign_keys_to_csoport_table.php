<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCsoportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('csoport', function (Blueprint $table) {
            $table->foreign(['ID_vezeto1'], 'csoport_ibfk_1')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE');
            $table->foreign(['ID_tabor'], 'csoport_ibfk_3')->references(['ID'])->on('tabor')->onUpdate('CASCADE');
            $table->foreign(['ID_vezeto2'], 'csoport_ibfk_2')->references(['ID'])->on('jelentkezo')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('csoport', function (Blueprint $table) {
            $table->dropForeign('csoport_ibfk_1');
            $table->dropForeign('csoport_ibfk_3');
            $table->dropForeign('csoport_ibfk_2');
        });
    }
}
