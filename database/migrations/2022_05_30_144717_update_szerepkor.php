<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSzerepkor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('szerepkor', function (Blueprint $table) {
            $table->boolean('isEnabled')->default(true);
            $table->string('leiras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('szerepkor', function (Blueprint $table) {
            $table->dropColumn(['isEnabled', 'leiras']);
        });
    }
}
