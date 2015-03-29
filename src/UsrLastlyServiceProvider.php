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

        $this->app->bind('UsrLastlyRepository', function(){
            $storage = '\HappyDemon\UsrLastly\Repositories\\' . ucfirst(config('usrlastly.storage', 'eloquent'));
            return new $storage();
        });

        $this->app->singleton('UsrLastlyUserLaravel', function(){
            return new HappyDemon\UsrLastly\Users\Laravel();
        });

        $this->app->singleton('UsrLastlyUser', function(){
           return app(config('usrlastly.user_provider', 'UsrLastlyUserLaravel'));
        });
	}

}
