<?php

namespace Sergiors\Pipeline\Tests;

use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Tests\Fixture\Bar;
use Sergiors\Pipeline\Tests\Fixture\Foo;

class PipelineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConcat()
    {
        $pipeline = (new Pipeline())
            ->pipe(function ($payload) {
                return $payload.'bar';
            })
            ->pipe(function ($payload) {
                return $payload.'foo';
            });

        $this->assertEquals('pipebarfoo', $pipeline('pipe'));
    }
}
