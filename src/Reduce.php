<?php

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Reduce
{
    /**
     * @var \Closure
     */
    private $fn;

    /**
     * @var mixed
     */
    private $initial;

    /**
     * @param \Closure $fn
     * @param null     $initial
     */
    public function __construct(\Closure $fn, $initial = null)
    {
        $this->fn = $fn;
        $this->initial = $initial;
    }

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload)
    {
        return array_reduce($payload, $this->fn, $this->initial);
    }
}
