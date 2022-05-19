<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJelentkezoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jelentkezo', function (Blueprint $table) {
            $table->integer('ID', true);
            $table->integer('ID_tabor')->nullable()->index('jel_tabor');
            $table->string('nev_elotag', 30)->nullable();
            $table->string('nev_vezetek', 30);
            $table->string('nev_kereszt', 50);
            $table->string('email')->nullable();
            $table->date('szuletesnap')->nullable();
            $table->date('nevnap')->nullable();
            $table->string('szallas_kulcsszo')->nullable();
            $table->string('nem', 1)->nullable();
            $table->smallInteger('eloleg')->default(0);
            $table->dateTime('eloleg_megerkezett')->nullable();
            $table->smallInteger('taborba_megerkezett')->nullable();
            $table->integer('ID_szallasszoba')->nullable();
            $table->integer('ID_csoport')->nullable()->index('ID_csoport');
            $table->integer('ID_aszf')->nullable()->index('jel_aszf');
            $table->dateTime('DATE_creation')->nullable();
            $table->dateTime('DATE_lastmod')->nullable();
            $table->unsignedInteger('ID_szerepkor')->nullable();
            $table->unsignedInteger('ID_user')->nullable();
            $table->integer('MOD_user')->nullable()->index('MOD_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jelentkezo');
    }
}
