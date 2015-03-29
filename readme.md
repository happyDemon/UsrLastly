UsrLastly
===

This nifty little package makes it easy to store and retrieve a user's 'last seen' status.

It's a light implementation that's easy to extend.

It uses a middleware to check if a user is logged in, if so it will store the user's current visit.

## Installation
First add the package to your composer file by runningthis command:
```
composer require happydemon/usrlastly
```

This will install the latest version.

Next add the service provider in your app.php config:

```php
    'providers' => [
        ...
        'HappyDemon\UsrLastly\UsrLastlyServiceProvider',
    ]
```

Next publish the config file:

```
php artisan vendor:publish
```

Now it's time to register `LastSeenMiddleware` as global middleware in `app/Http/Kernel.php`:

```php
	protected $middleware = [
		...
		'HappyDemon\UsrLastly\Middleware\LastSeenMiddleware'
	];
```

Lastly let's move on to your user model, open it and add the required trait:
       
Above your class reference the trait
       
```php
use HappyDemon\UsrLastly\LastSeenTrait as LastSeen;
```
       
and in your user model add
       
```php
use LastSeen;
```

## Storages

I've bundled 2 types of storage, this is where the 'last seen status' gets stored.

You can either store this status in your database or with Redis.

### Database

To let this package do its work you'll first need to publish and run a database migration

```php
php artisan vendor:publish --provider="HappyDemon\UsrLastly\UsrLastlyServiceProvider" --tag="migrations"
php artisan migrate
```

That should have prepared your database and you should be ready.

### Redis

This storage requires even less setup, all you have to do is open up `config/userlastly.php` and change the `storage` key to `redis`

## User provider

I'm sure not everybody is using Laravel's built-in Auth to handle user authentication so I've extracted this bit too,
at this moment though it's the only auth implemented.

This is something that's used by the package, not something other developers should worry about.

We can do this in 3 steps:

 - Create a class that implements `HappyDemon\UsrLastly\User` with a `getUser()` method that returns a logged in user or false
 - Binding that class to laravel's container
 - Change `config/userlastly.php`'s `user_provider` key to name of that binding.
 
You can check the docs for the worked out example.
 
## Retrieving 'last seen' status
 
Load your user like you would normally and call `lastSeen()`, as an example I'll just grab the first user in the database:

```php
$user = User::find(1);

dd($user->lastSeen());
```

That method should return an object with 2 properties:

 - *date* which is a `Carbon` date object
 - *request*, an array which holds information on where the user was