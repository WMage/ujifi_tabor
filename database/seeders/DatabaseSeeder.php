<?php

use Database\Seeders\CsoportTableSeeder;
use Database\Seeders\JelentkezoJogTableSeeder;
use Database\Seeders\JelentkezoSegitomunkaTableSeeder;
use Database\Seeders\JelentkezoTableSeeder;
use Database\Seeders\JogTableSeeder;
use Database\Seeders\NapokTableSeeder;
use Database\Seeders\OauthAccessTokensTableSeeder;
use Database\Seeders\OauthClientsTableSeeder;
use Database\Seeders\OauthPersonalAccessClientsTableSeeder;
use Database\Seeders\SegitomunkaTableSeeder;
use Database\Seeders\SzerepkorJogTableSeeder;
use Database\Seeders\SzerepkorTableSeeder;
use Database\Seeders\TaborTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TaborTableSeeder::class);
        $this->call(SzerepkorTableSeeder::class);
        $this->call(SegitomunkaTableSeeder::class);
        $this->call(JogTableSeeder::class);
        $this->call(SzerepkorJogTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthAccessTokensTableSeeder::class);
        $this->call(NapokTableSeeder::class);
        $this->call(JelentkezoTableSeeder::class);
        $this->call(CsoportTableSeeder::class);
        $this->call(JelentkezoSegitomunkaTableSeeder::class);
        $this->call(JelentkezoJogTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
