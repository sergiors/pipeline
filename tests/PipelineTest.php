<?php

namespace Sergiors\Pipeline\Tests;

use PHPUnit\Framework\TestCase;
use Sergiors\Pipeline\Pipeline;
use Sergiors\Pipeline\Tests\Fixture\Bar;
use Sergiors\Pipeline\Tests\Fixture\Foo;

class PipelineTest extends TestCase
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
            ->pipe(new Foo());

        $this->assertEquals('pipebarfoo', $pipeline('pipe'));


    }

    /**
     * @test
     * @expectedException \Throwable
     */
    public function shouldSkipNonCallable()
    {
        $pipeline = (new Pipeline(new Bar()))
            ->pipe(new Foo());

        $this->assertEquals('pipefoo', $pipeline('pipe'));
    }

    /**
     * @test
     */
    public function shouldFilterArticles()
    {
        $articles = [
            [
                'title' => 'PHP Rocks!',
                'tags' => ['php']
            ],
            [
                'title' => 'How to use Python with GTK',
                'tags' => ['python', 'gtk']
            ],
            [
                'title' => 'How to use Pipeline',
                'tags' => ['php', 'pipeline']
            ]
        ];

        $pipeline = (new Pipeline())
            ->pipe(function ($payload) {
                return array_filter($payload, function ($article) {
                    return in_array('php', $article['tags']);
                });
            })
            ->pipe(function ($payload) {
                return array_map(function ($article) {
                    return $article['title'];
                }, $payload);
            })
            ->pipe('array_values');

        $xs = $pipeline($articles);

        $this->assertCount(2, $xs);
        $this->assertEquals('PHP Rocks!', $xs[0]);
        $this->assertEquals('How to use Pipeline', $xs[1]);
    }
}
