<?php

namespace Sergiors\Pipeline\Tests\Fixture;

class Foo
{
    public function __invoke($payload)
    {
        return $payload.'foo';
    }
}
