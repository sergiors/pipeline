<?php

declare(strict_types = 1);

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Map
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }
    
    public function __invoke($payload)
    {
        return array_map($this->callable, $payload);
    }
}
