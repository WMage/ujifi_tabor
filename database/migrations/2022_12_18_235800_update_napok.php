<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNapok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('napok', function (Blueprint $table) {
            $table->renameColumn('reggeli_kerheto', 'reggeli');
            $table->renameColumn('tizorai_kerheto', 'tizorai');
            $table->renameColumn('ebed_kerheto', 'ebed');
            $table->renameColumn('uzsonna_kerheto', 'uzsonna');
            $table->renameColumn('vacsora_kerheto', 'vacsora');
            $table->renameColumn('szallas_kerheto', 'szallas');
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
            $table->renameColumn('reggeli', 'reggeli_kerheto');
            $table->renameColumn('tizorai', 'tizorai_kerheto');
            $table->renameColumn('ebed', 'ebed_kerheto');
            $table->renameColumn('uzsonna', 'uzsonna_kerheto');
            $table->renameColumn('vacsora', 'vacsora_kerheto');
            $table->renameColumn('szallas', 'szallas_kerheto');
        });
    }
}
