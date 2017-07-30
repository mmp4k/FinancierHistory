<?php

namespace App\Query;

use App\Query\Model\HistoryData;

interface QueryHistory
{
    public function findLastAsset(string $asset) : HistoryData;
}