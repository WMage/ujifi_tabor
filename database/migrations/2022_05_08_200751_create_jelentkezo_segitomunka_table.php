<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJelentkezoSegitomunkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jelentkezo_segitomunka', function (Blueprint $table) {
            $table->integer('ID_jelentkezo')->nullable();
            $table->integer('ID_segito_munka')->nullable()->index('ID_segito_munka');

            $table->unique(['ID_jelentkezo', 'ID_segito_munka'], 'ID_jelentkezo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jelentkezo_segitomunka');
    }
}
