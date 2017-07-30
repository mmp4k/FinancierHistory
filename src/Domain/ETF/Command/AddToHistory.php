<?php

declare(strict_types=1);

namespace Domain\ETF\Command;

use Domain\ETF\Command;

class AddToHistory implements Command
{
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $date;
    /**
     * @var float
     */
    private $openPrice;
    /**
     * @var float
     */
    private $closePrice;
    /**
     * @var float
     */
    private $highPrice;
    /**
     * @var float
     */
    private $lowPrice;
    /**
     * @var int
     */
    private $volume;

    public function __construct(string $code, string $date, float $openPrice, float $closePrice, float $highPrice, float $lowPrice, int $volume)
    {
        $this->code = $code;
        $this->date = $date;
        $this->openPrice = $openPrice;
        $this->closePrice = $closePrice;
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
        $this->volume = $volume;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function openPrice(): float
    {
        return $this->openPrice;
    }

    public function closePrice(): float
    {
        return $this->closePrice;
    }

    public function highPrice(): float
    {
        return $this->highPrice;
    }

    public function lowPrice(): float
    {
        return $this->lowPrice;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function volume(): int
    {
        return $this->volume;
    }
}
