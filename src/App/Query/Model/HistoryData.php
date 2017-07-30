<?php

namespace App\Query\Model;

class HistoryData
{
    /**
     * @var string
     */
    public $asset;
    /**
     * @var \DateTime
     */
    public $date;
    /**
     * @var int
     */
    public $highPrice;
    /**
     * @var int
     */
    public $lowPrice;
    /**
     * @var int
     */
    public $openPrice;
    /**
     * @var int
     */
    public $closePrice;
    /**
     * @var int
     */
    public $volume;

    public function __construct(string $asset, \DateTime $date, int $highPrice, int $lowPrice, int $openPrice, int $closePrice, int $volume)
    {
        $this->asset = $asset;
        $this->date = $date->format('Y-m-d');
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
        $this->openPrice = $openPrice;
        $this->closePrice = $closePrice;
        $this->volume = $volume;
    }
}