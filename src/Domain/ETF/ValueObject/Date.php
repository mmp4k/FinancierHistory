<?php

declare(strict_types=1);

namespace Domain\ETF\ValueObject;

class Date
{
    /**
     * @var \DateTime
     */
    private $date;

    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }

    public function date(): \DateTime
    {
        return $this->date;
    }

    public function year(): int
    {
        return (int)$this->date->format('Y');
    }

    public function isBusinessDay(): bool
    {
        return $this->date->format('N') < 6;
    }

    public function month(): int
    {
        return (int)$this->date->format('m');
    }

    public function day(): int
    {
        return (int)$this->date->format('d');
    }

    public function plainDate(): string
    {
        return $this->date()->format('Y-m-d');
    }
}
