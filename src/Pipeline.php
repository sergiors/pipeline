<?php

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Pipeline
{
    /**
     * @var callable[]
     */
    private $callbacks;

    /**
     * @param array $callbacks
     */
    public function __construct(array $callbacks = [])
    {
        $this->callbacks = array_filter($callbacks, 'is_callable');
    }

    /**
     * @param callable $callback
     *
     * @return Pipeline
     */
    public function pipe(callable $callback)
    {
        return new self(array_merge($this->callbacks, [$callback]));
    }

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload /* ...$args */)
    {
        $rest = array_slice(func_get_args(), 1);

        return array_reduce($this->callbacks, function ($payload, $callback) use ($rest) {
            return call_user_func_array($callback, array_merge([$payload], $rest));
        }, $payload);
    }

    /**
     * @return mixed
     */
    public function __invoke(/* ...$args */)
    {
        return call_user_func_array([$this, 'process'], func_get_args());
    }
}
