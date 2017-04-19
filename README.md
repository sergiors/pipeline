Pipeline
--------
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sergiors/pipeline/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sergiors/pipeline/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sergiors/pipeline/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sergiors/pipeline/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/sergiors/pipeline/badges/build.png?b=master)](https://scrutinizer-ci.com/g/sergiors/pipeline/build-status/master)

Install
-------
```bash
composer require sergiors/pipeline
```

How to use
----------

```php
use Sergiors\Pipeline\Pipeline;

$pipeline = (new Pipeline)
    ->pipe(function ($payload) {
        return $payload + 2;
    })
    ->pipe(function ($payload) {
        return $payload * 2;
    });

echo $pipeline(10); // => 24
// echo $pipeline->process(10);
```

```php
$pipeline = (new Pipeline)
    ->pipe(function ($payload, $container) {
        ...
    })
    ->pipe(function ($payload, $container) {
        ...
    });

$container = ...;
$pipeline(10, $container);
```

You can use `Sergiors\Pipeline\Reduce`, `Sergiors\Pipeline\Filter` and `Sergiors\Pipeline\Map` to compose the pipeline more readable.

```php
use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Filter;

$getOrgs = (new Pipeline)
    ->pipe(new Filter(function ($org) {
        return $org instanceof OrgInterface;
    }));

// an array with OrgInterface and UserInterface objects
$users = [...];

print_r($getOrgs($users));
```

Motivation
----------
[Collection Pipeline](http://martinfowler.com/articles/collection-pipeline/)


License
-------
MIT
