# silex-starter
Silex starter project.

## Composer

run `composer install` in the app root folder to install dependencies

## Database

### Migrations

[phinx](phinx.org)

run `php vendor/bin/phinx` in the app root folder for commands

// TODO: Move to doctrine migrations

### Models and Queries

// TODO

## Routes and Controllers

Add your route definitions to `app/app.php`.
There is a home route there for your reference:

```php
$app->get('/', 'SilexStarter\Controller\HomeController::index')
    ->bind('home');
```

This route will direct the uri `/` to the index method of the 'SilexStarter\Controller\HomeController' class. The bind command will allow you to reference this route in your templates like this: `{{ path('home') }}`.

Check out the [official docs](http://silex.sensiolabs.org/doc/usage.html#routing) for more info.

### Caching

If you want to cache a response, simply add the `Cache-Control` header to something like `s-maxage=3600, public`. The standard setup will use the cache folder to store response and serve responses from there without having to bootstrap the app.

## Unit Tests

Put your phpunit tests in the `tests/` folder. Extend the `\SilexStarter\Test\AbstractTestCase` class in order to have access to things like the web crawler. Here's an example:

```php
use \SilexStarter\Test\AbstractTestCase;

class SomeTest extends AbstractTestCase
{
    public function testSomething()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
    
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h1:contains("Hello World")'));
    }
}
```

Check out the [official documentation](http://silex.sensiolabs.org/doc/testing.html) for more info.

## Logging

The logging service is available by using $app['monolog']. The log files reside in `app/logs/`. Here are some examples:

```php
$app['monolog']->info('script started');
$app['monolog']->error('Failed to call function', ['key', $value]);
```