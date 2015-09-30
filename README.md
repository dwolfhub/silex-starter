# silex-starter
Silex starter project.

## Composer

run `./composer.phar install` in the app root folder to install dependencies

## Database

### Migrations

Migrations are stored in the `src/Resource/Migration` folder. Run `./app/console` in the app root folder to view migration commands:

```Text
migrations
  migrations:diff      Generate a migration by comparing your current database to your mapping information.
  migrations:execute   Execute a single migration version up or down manually.
  migrations:generate  Generate a blank migration class.
  migrations:migrate   Execute a migration to a specified version or the latest available version.
  migrations:status    View the status of a set of migrations.
  migrations:version   Manually add and delete migration versions from the version table.
```

### Query Repositories

The abstract query repository can be found in `src/QueryRepository/`. Extend it to create your own repositories. Then use them like so:

```php
$myRepo = new SilexStarter\QueryRepository\MyQueryRepo($app['db']);
$results = $myRepo->myMethod();
```

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

## Views

### Twig

[Twig](http://twig.sensiolabs.org/) templates should be placed in `frontend/twig`. Render a template using `$app['twig']->render('filename.html.twig', ['mykey' => 'myvalue']);`.

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