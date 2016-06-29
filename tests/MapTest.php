<?php

namespace Sergiors\Pipeline\Tests;

use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Map;

class MapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnMapped()
    {
        $band = [
            [
                'name' => 'James',
                'instrument' => 'Vocal'
            ],
            [
                'name' => 'Kirk',
                'instrument' => 'Guitar'
            ]
        ];

        $pipeline = (new Pipeline())
            ->pipe(new Map(function ($member) {
                return $member['name'];
            }));

        $this->assertEquals(['James', 'Kirk'], $pipeline($band));
    }
}
