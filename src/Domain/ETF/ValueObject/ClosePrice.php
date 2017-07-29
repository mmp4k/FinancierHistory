<?php

declare(strict_types=1);

namespace Domain\ETF\ValueObject;

class ClosePrice
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function zloty(): float
    {
        return (float)number_format($this->value / 100, 2, '.', '');
    }

    public function value(): int
    {
        return $this->value;
    }
}
