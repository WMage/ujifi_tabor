<?php

namespace App\Providers;

use App\Connection\WMMysqlConnection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\MySqlConnector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Connection::resolverFor("wm_mysql", function ($connection, $database, $prefix, $config){
            return new WMMysqlConnection($connection, $database, $prefix, $config);
        });
        $this->app->singleton('db.connector.wm_mysql', function ($app) {
            return new MySqlConnector;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

