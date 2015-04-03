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

If you ever changed the `storage` key, you could reset it to `UsrLastlyStorageEloquent`.

### Redis

This storage requires even less setup, all you have to do is open up `config/usrlastly.php` and change the `storage` key to `UsrLastlyStorageRedis`