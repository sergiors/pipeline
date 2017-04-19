<?php

declare(strict_types = 1);

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Reduce
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * @var mixed
     */
    private $initial;

    public function __construct(callable $callable, $initial = null)
    {
        $this->callable = $callable;
        $this->initial = $initial;
    }

    public function __invoke($payload)
    {
        return array_reduce($payload, $this->callable, $this->initial);
    }
}
