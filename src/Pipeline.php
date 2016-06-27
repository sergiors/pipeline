<?php

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Pipeline
{
    private $callbacks;

    public function __construct(array $callbacks = [])
    {
        $this->callbacks = array_filter($callbacks, 'is_callable');
    }

    public function pipe(callable $callback)
    {
        return new self(array_merge($this->callbacks, [$callback]));
    }

    public function process($payload /* ...$args */)
    {
        $args = array_slice(func_get_args(), 1);

        return array_reduce($this->callbacks, function ($payload, $callback) use ($args) {
            return call_user_func_array($callback, array_merge([$payload], $args));
        }, $payload);
    }

    public function __invoke(/* ...$args */)
    {
        return call_user_func_array([$this, 'process'], func_get_args());
    }
}
