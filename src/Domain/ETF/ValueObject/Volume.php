<?php

declare(strict_types=1);

namespace Domain\ETF\ValueObject;

class Volume
{
    /**
     * @var int
     */
    private $volume;

    public function __construct(int $volume)
    {
        $this->volume = $volume;
    }

    public function value(): int
    {
        return $this->volume;
    }
}
