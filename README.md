<p align="center">
    <a href="https://github.com/htmlacademy-yii/2074903-task-force-4">
        <img src="web/img/logo.svg" width=227 height=60 alt="taskforce">
    </a>
    <h1 align="center">Куплю. Продам</h1>
    <h3 align="center">study project by Olga Marinina</h3>
</p>
<p align="center">
<img src="https://img.shields.io/badge/php-%5E8.1.0-blue">
<img src="https://img.shields.io/badge/mysql-~8.0.31-orange">
<img src="https://img.shields.io/badge/yii2-~2.0.45-green">
<img src="https://img.shields.io/badge/phpunit-~9.5.0-blue">

[//]: # (<img src="https://img.shields.io/badge/redis-5-red">)
</p>
<br>

* Student: [Olga Marinina](https://up.htmlacademy.ru/yii/4/user/2074903).
* Mentor: [Mikhail Selyatin](https://htmlacademy.ru/profile/id919955).
* Manager: Nadezhda Soboleva

About project
-------------------

"Куплю. Продам" is an Internet service that simplifies the sale or purchase of any things.
All that is required for the purchase: find a suitable ad and contact the seller by email.
It's no more difficult to sell unnecessary things: register and fill out the form for a new ad.

### Main use cases

* Publishing an ad
* Adding a comment to an ad
* Search for ads by name and categories
* Chat between seller and buyer
* Editing an ad
* Delete ads and comments



DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      docker/             contains data from DB volumes
      fixtures/           contains fake data for DB
      mail/               contains view files for e-mails
      migrations/         contains migrations to create current tables for DB
      runtime/            contains files generated during runtime
      src/                contains classes (domain, infrustacture, application)
        application/      contains classes for services
        domain/           contains models of main entities and helpers (traits, task actions)
        infrastructure/   contains helped models (forms) and constants
      tests/              contains various tests for the basic application (just unit)
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      widgets/            contains some widgets



REQUIREMENTS
------------

We work on this project with docker-compose.

**Images**:
* yiisoftware/yii2-php:8.1-apache
* mysql:8.0.31

You can then access the application locally through the following URL:

    http://127.0.0.1:8000



CONFIGURATION
-------------

### Database

File `config/db.php` with real data. For example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


### Migrations

Migrations can be started via the command

```
docker-compose run php ./yii migrate
```

Migrations can be denied via the command

```
docker-compose run --rm php ./yii migrate/down
```


### Fake data aka fixtures

We have already generated data and add they `app/fistures/data`.
You should run they sequentially via the command (for example, for ExampleFixture)

```
docker-compose run --rm php yii fixture/load Example
```

**The sequence**:
1. Users
2. Ads
3. AdsToCategories
4. Comments

If you want to generate your personal data then use our templates in `app/fixtures/templates` but you should keep *these rules*:
1. absolutely follow the sequence above
2. generate data one at a time
3. run the same fixture
4. take new table and generate data for this

The command to generate data

```
docker-compose run --rm php yii fixture/generate example --count=n
```



TESTING
-------

Tests are located in `tests` directory. We use only unit tests on this project.

Unit tests can be executed by running

```
vendor/bin/codecept run unit
```

The command above will execute unit. Unit tests are testing the system components.


### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
