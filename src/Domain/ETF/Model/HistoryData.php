<?php

declare(strict_types=1);

namespace Domain\ETF\Model;

use Domain\ETF\ValueObject\Asset;
use Domain\ETF\ValueObject\ClosePrice;
use Domain\ETF\ValueObject\Date;
use Domain\ETF\ValueObject\HighPrice;
use Domain\ETF\ValueObject\LowPrice;
use Domain\ETF\ValueObject\OpenPrice;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class HistoryData
{
    /**
     * @var Date
     */
    private $date;
    /**
     * @var Asset
     */
    private $asset;
    /**
     * @var OpenPrice
     */
    private $openPrice;
    /**
     * @var ClosePrice
     */
    private $closePrice;
    /**
     * @var HighPrice
     */
    private $highPrice;
    /**
     * @var LowPrice
     */
    private $lowPrice;
    /**
     * @var UuidInterface
     */
    private $uuid;

    public function __construct(Date $date, Asset $asset, OpenPrice $openPrice, ClosePrice $closePrice, HighPrice $highPrice, LowPrice $lowPrice)
    {
        $this->uuid = Uuid::uuid4();
        $this->date = $date;
        $this->asset = $asset;
        $this->openPrice = $openPrice;
        $this->closePrice = $closePrice;
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function date(): Date
    {
        return $this->date;
    }

    public function openPrice(): OpenPrice
    {
        return $this->openPrice;
    }

    public function closePrice(): ClosePrice
    {
        return $this->closePrice;
    }

    public function highPrice(): HighPrice
    {
        return $this->highPrice;
    }

    public function lowPrice(): LowPrice
    {
        return $this->lowPrice;
    }

    public function asset(): Asset
    {
        return $this->asset;
    }
}
