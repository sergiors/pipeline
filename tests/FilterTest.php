<?php

namespace Sergiors\Pipeline\Tests;

use PHPUnit\Framework\TestCase;
use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Filter;
use Sergiors\Pipeline\Map;

class FilterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnFiltered()
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

        $guitars = (new Pipeline())
            ->pipe(new Filter(function ($member) {
                return $member['instrument'] === 'Guitar';
            }))
            ->pipe(new Map(function ($member) {
                return $member['name'];
            }))
            ->pipe('array_values');

        $this->assertEquals(['Kirk'], $guitars($band));
    }
}
