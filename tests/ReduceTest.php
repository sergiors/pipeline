<?php

namespace Sergiors\Pipeline\Tests;

use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Reduce;

class ReduceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnOneValue()
    {
        $pipeline = (new Pipeline())
            ->pipe(new Reduce(function ($acc, $n) {
                return $acc + $n;
            }));

        $this->assertEquals(5, $pipeline([1, 2, 2]));
    }
}
