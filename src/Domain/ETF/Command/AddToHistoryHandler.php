<?php

declare(strict_types=1);

namespace Domain\ETF\Command;

use Domain\ETF\History;
use Domain\ETF\Model\HistoryData;
use Domain\ETF\ValueObject\Asset;
use Domain\ETF\ValueObject\ClosePrice;
use Domain\ETF\ValueObject\Date;
use Domain\ETF\ValueObject\HighPrice;
use Domain\ETF\ValueObject\LowPrice;
use Domain\ETF\ValueObject\OpenPrice;
use Domain\ETF\ValueObject\Volume;

class AddToHistoryHandler
{
    /**
     * @var History
     */
    private $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function handle(AddToHistory $command): void
    {
        $data = new HistoryData(
            new Date(new \DateTime($command->date())),
            new Asset($command->code()),
            new OpenPrice((int)($command->openPrice() * 100)),
            new ClosePrice((int)($command->closePrice() * 100)),
            new HighPrice((int)($command->highPrice() * 100)),
            new LowPrice((int)($command->lowPrice() * 100)),
            new Volume((int)$command->volume())
        );
        $this->history->add($data);
    }
}
