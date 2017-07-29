<?php

declare(strict_types=1);

namespace Domain\ETF;

use Domain\ETF\Model\HistoryData;

interface History
{
    public function add(HistoryData $historyData): void;
}
