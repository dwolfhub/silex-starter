# silex-starter
Silex starter project.

## Composer

run `./composer.phar install` in the app root folder to install dependencies

## Configuration

Config files are located in `app/config`. Copy the `local-sample.yml` file and name it `local.yml` to override all other configuration files. If that does not exist, it will see if the environment variable `APPLICATION_ENV` is set and load a `<APPLICATION_ENV>.yml` file. If that doesn't exist, the `default.yml` will be loaded as a baseline.

## Frontend

### npm
[npm](https://www.npmjs.com/) is the package manager used for installing build tools as well as third-party dependencies. Configuration is located in `package.json`.

Run `npm install` to download required tools and modules.

### JavaScript

JavaScript files are located in `frontend/js`. The main entry point for the app is `app.js`. The JavaScript is organized in AMD format.

### Webpack
[Webpack](https://webpack.github.io/) is a module loader and asset bundler. In this project it's used to bundle and uglify JavaScript. The configuration for Webpack is `webpack.config.js`. Third-party modules, such as [FastClick](https://github.com/ftlabs/fastclick) or [jQuery](https://github.com/jquery/jquery) can be added as `dependencies` in `package.json`, and added as a module via the `alias` configuration in `webpack.config.js`.

[Webpack Documentation](http://webpack.github.io/docs/)

### SASS

[SASS](http://sass-lang.com/) is used for extending CSS with new features and compiles into CSS. The SASS files are located at `frontend/scss`, and the main SASS file is `style.scss`.

### Task Runner

`Gulp` is the task runner used to automate compilation tasks. `gulpfile.js` is the configuration file.

Run `gulp` to perform the default task.

Use `gulp watch` to watch for file changes and livereload the page in real time.

```Text
Gulp tasks
watch      watches files in `frontend` and runs `sass or `build-js` tasks
clean      removes old versions of JS and CSS files from `public_html\assets`
uglify-js  uglifies and disables debug mode for webpack
build-js   compiles JavaScript AMD modules into app.js
sass       compiles SASS files
default    runs `clean`, `build-js`, and `sass` tasks
dev        alias of `dev` task
test       alias of `prod` task
staging    alias of `prod` task
uat        alias of `prod` task
master     alias of `prod` task
prod       runs `clean`, `uglify-js`m `build-js`, and `sass` tasks


```




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

```Text
Global Variables
debug         Boolean containing the application debug state
js_filename   dynamically revisioned name of the compiled JavaScript modules
css_filename  dynamically revisioned name of the compiled SASS files

```

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