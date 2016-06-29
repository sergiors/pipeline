<?php

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Filter
{
    /**
     * @var \Closure
     */
    private $fn;

    /**
     * @param \Closure $fn
     */
    public function __construct(\Closure $fn)
    {
        $this->fn = $fn;
    }

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload)
    {
        return array_filter($payload, $this->fn);
    }
}
