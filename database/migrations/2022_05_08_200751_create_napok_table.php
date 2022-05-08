<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNapokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('napok', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->date('datum');
            $table->boolean('reggeli_kerheto')->default(false);
            $table->boolean('tizorai_kerheto')->default(false);
            $table->boolean('ebed_kerheto')->default(false);
            $table->boolean('uzsonna_kerheto')->default(false);
            $table->boolean('vacsora_kerheto')->default(false);
            $table->boolean('szallas_kerheto')->default(false);
            $table->integer('ID_tabor')->index('ID_tabor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('napok');
    }
}
