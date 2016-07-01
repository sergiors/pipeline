<?php

namespace Sergiors\Pipeline;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Pipeline
{
    /**
     * Placeholder
     */
    const _ = '%';

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
     * @param callable $fn
     * @param array    $args
     *
     * @return Pipeline
     */
    public function __call(callable $fn, array $args)
    {
        $ks = (new self())
            ->pipe(new Filter(function ($x) {
                return self::_ === $x;
            }))
            ->pipe('array_keys')
            ->process($args);

        return $this->pipe(function ($payload) use ($fn, $args, $ks) {
            if ([] === $ks) {
                return call_user_func_array($fn, array_merge($args, [$payload]));
            }

            return call_user_func_array($fn, array_replace($args, [
                $ks[0] => $payload
            ]));
        });
    }

    /**
     * @return mixed
     */
    public function __invoke(/* ...$args */)
    {
        return call_user_func_array([$this, 'process'], func_get_args());
    }
}
