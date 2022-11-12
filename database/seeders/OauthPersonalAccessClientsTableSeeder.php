<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthPersonalAccessClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('oauth_personal_access_clients')->insert(array (
            0 =>
            array (
                'client_id' => 1,
                'created_at' => '2022-04-25 01:16:52',
                'id' => 1,
                'updated_at' => '2022-04-25 01:16:52',
            ),
        ));


    }
}
