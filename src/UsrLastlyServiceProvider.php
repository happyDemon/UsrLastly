<?php

namespace HappyDemon\UsrLastly;

use Illuminate\Support\ServiceProvider;

class UsrLastlyServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->publishes([__DIR__.'/../config/usrlastly.php' => config_path('usrlastly.php')]);

        // Optionally users can also publish migrations
        $this->publishes([
            __DIR__.'/../migrations/' => base_path('/database/migrations')
        ], 'migrations');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(
            __DIR__.'/../config/usrlastly.php', 'usrlastly'
        );

        $this->app->bind('UsrLastlyStorageEloquent', '\HappyDemon\UsrLastly\Repositories\Eloquent');
        $this->app->bind('UsrLastlyStorageRedis', '\HappyDemon\UsrLastly\Repositories\Redis');

        $this->app->bind('UsrLastlyRepository', function($app){
            return $app->make(config('usrlastly.storage', 'UsrLastlyStorageEloquent'));
        });

        $this->app->singleton('UsrLastlyUserLaravel', function(){
            return new Users\Laravel();
        });

        $this->app->singleton('UsrLastlyUser', function(){
           return app(config('usrlastly.user_provider', 'UsrLastlyUserLaravel'));
        });
	}

}
