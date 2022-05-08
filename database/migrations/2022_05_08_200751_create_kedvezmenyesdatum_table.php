<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKedvezmenyesdatumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kedvezmenyesdatum', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->date('datum')->nullable();
            $table->integer('ID_tabor')->nullable()->index('ID_tabor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kedvezmenyesdatum');
    }
}
