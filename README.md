# silex-starter
Silex starter project.


## Composer

run `composer install` in the app root folder to install dependencies


## Database

### Migrations

[phinx](phinx.org)

run `php vendor/bin/phinx` in the app root folder for commands

### Models and Queries

// TODO

## Routes and Controllers

### Caching

If you want to cache a response, simply add the `Cache-Control` header to something like `s-maxage=3600, public`. 
The standard setup will use the cache folder to store response and serve responses from there without having to bootstrap the app.


## Authentication

Add routes you wish to secure to the `$secureRoutes` array in app/app.php.
Login is done with an email and username posted to `/login`. 
Add the returned token to the headers of authenticated requests as `X-Auth-Token`.
Invalidate a token with `/logout`.

## Unit Tests

// TODO