<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJelentkezoNapokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jelentkezo_napok', function (Blueprint $table) {
            $table->integer('ID_jelentkezo')->nullable()->index('ID_jelentkezo');
            $table->integer('ID_napok')->nullable()->index('ID_napok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jelentkezo_napok');
    }
}
