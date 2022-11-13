<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('oauth_access_tokens')->insert(array (
            0 =>
            array (
                'client_id' => 1,
                'created_at' => '2022-04-25 01:39:30',
                'expires_at' => '2023-04-25 01:39:30',
                'id' => '59130d5aac11f00b5bc3cb091867bde9f32b1330f03f4145fba3745ceff9ecd83150df14c34404fc',
                'name' => 'api-application',
                'revoked' => 0,
                'scopes' => '[]',
                'updated_at' => '2022-04-25 01:39:30',
                'user_id' => 1,
            ),
            1 =>
            array (
                'client_id' => 1,
                'created_at' => '2022-04-25 01:37:46',
                'expires_at' => '2023-04-25 01:37:46',
                'id' => '9eccc9d235d1db8608b6db4c05e8a96bcd46ec8259eccd12976ce38dd7ff8a38b27a21279694fb6b',
                'name' => 'api-application',
                'revoked' => 0,
                'scopes' => '[]',
                'updated_at' => '2022-04-25 01:37:46',
                'user_id' => 1,
            ),
            2 =>
            array (
                'client_id' => 1,
                'created_at' => '2022-04-25 01:39:48',
                'expires_at' => '2023-04-25 01:39:48',
                'id' => '9f2d110c439186c4f345d642442d2b5d948a6c0f6980c581c3dca29279c2b0d822c5afe9a592f076',
                'name' => 'api-application',
                'revoked' => 0,
                'scopes' => '[]',
                'updated_at' => '2022-04-25 01:39:48',
                'user_id' => 1,
            ),
        ));


    }
}
