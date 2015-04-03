Usr.Lastly
===

This package was created for developers who want to store their users' last visit to their site.

I wanted it to be simple by design, while keeping it easy to extend to fit your needs.

With that in mind, I made it easy to define a storage (Redis & Database come bundled) and a user provider (Laravel's auth comes bundled).

## Retrieving 'last seen' status
 
Load your user like you would normally and call `lastSeen()`, as an example I'll just grab the first user in the database:

```php
$user = User::find(1);

dd($user->lastSeen());
```

That method should return an object with 2 properties:

 - *date* which is a `Carbon` date object
 - *request*, an array which holds information on where the user was

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