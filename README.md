Pipeline
--------

```php
use Sergiors\Pipeline\Pipeline;

$pipeline = (new Pipeline())
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
$pipeline = (new Pipeline())
    ->pipe(function ($payload, $container) {
        ...
    })
    ->pipe(function ($payload, $container) {
        ...
    });

$container = ...;
$pipeline(10, $container);
```

License
-------
MIT
