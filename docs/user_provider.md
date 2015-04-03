Create your own user provider

I'm sure not everybody is using Laravel's built-in Auth to handle user authentication so I've extracted this bit too,
at this moment though it's the only auth implemented.

This is something that's used by the package, not something other developers should worry about.

We can do this in 3 steps:

 - Create a class that implements `HappyDemon\UsrLastly\User` with a `getUser()` method that returns a logged in user or false
 - Binding that class to laravel's container
 - Change `config/userlastly.php`'s `user_provider` key to name of that binding.
 
Let's go ahead and make a user provider for [cartalyst/sentry](https://github.com/cartalyst/sentry):
 
Let's create a new file in `app/UsrLastly` called `SentryUserProvider.php`.

As I mentioned this class should implement `HappyDemon\UsrLastly\User`, which forces you to have a `getUser()` method.

This method should either return a user object (Eloquent model) or false if no one's logged in.

```php

	<?php
	
	namespace App\UsrLastly;
	
	
	use Cartalyst\Sentry\Facades\Laravel\Sentry;
	use HappyDemon\UsrLastly\User;
	
	class SentryUserProvider implements User {
	
	    public function getUser()
	    {
	        return (Sentry::check()) ? Sentry::getUser() : false;
	    }
	}
```

Next up we need to register this class in the IOC container, so open up `app/Providers/AppServiceProvider.php`, in the `register()` method we're going to add our binding:

```php
$this->app->singleton('UsrLastlyUserSentry', function(){
            return new App\UsrLastly\SentryUserProvider();
        });
```

All that's left to do is making use of it, if you open up `config/usrlastly.php` and change the `user_provider` key to `UsrLastlyUserSentry` you're all done.