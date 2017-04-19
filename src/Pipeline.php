<?php

declare(strict_types = 1);

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

    public function __construct(callable ...$callbacks)
    {
        $this->callbacks = $callbacks;
    }

    public function pipe(callable $callback): self
    {
        return new self(...array_merge($this->callbacks, [$callback]));
    }

    public function process($payload, ...$restParams)
    {
        return array_reduce($this->callbacks,
            function ($payload, callable $callback) use ($restParams) {
                return $callback(...array_merge([$payload], $restParams));
            }, $payload);
    }

    public function __invoke(...$args)
    {
        return $this->process(...$args);
    }
}
