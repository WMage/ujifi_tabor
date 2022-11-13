<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('oauth_clients')->insert(array (
            0 =>
            array (
                'created_at' => '2022-04-25 01:16:52',
                'id' => 1,
                'name' => 'Laravel Personal Access Client',
                'password_client' => 0,
                'personal_access_client' => 1,
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => '8IDl23czllNkv4ASqHOqTwreIp55IoDhLEfOInD8',
                'updated_at' => '2022-04-25 01:16:52',
                'user_id' => NULL,
            ),
            1 =>
            array (
                'created_at' => '2022-04-25 01:16:52',
                'id' => 2,
                'name' => 'Laravel Password Grant Client',
                'password_client' => 1,
                'personal_access_client' => 0,
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => 'qI57fOWK9inv6HXauu4Lu7P7Depi5nAXVk47j5yz',
                'updated_at' => '2022-04-25 01:16:52',
                'user_id' => NULL,
            ),
        ));


    }
}
