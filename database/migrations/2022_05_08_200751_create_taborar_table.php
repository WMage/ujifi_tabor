<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaborarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taborar', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('ID_tabor')->nullable()->index('ID_tabor');
            $table->integer('AR_reggeli')->nullable();
            $table->integer('AR_tizorai')->nullable();
            $table->integer('AR_ebed')->nullable();
            $table->integer('AR_uzsonna')->nullable();
            $table->integer('AR_vacsora')->nullable();
            $table->integer('AR_jelenlet')->nullable();
            $table->integer('AR_szallas')->nullable();
            $table->integer('ID_kor')->nullable()->index('ID_kor');
            $table->integer('ID_kedvdatum')->nullable()->index('ID_kedvdatum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taborar');
    }
}
