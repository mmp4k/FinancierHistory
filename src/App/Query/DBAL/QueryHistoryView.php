<?php

namespace App\Query\DBAL;

use App\Query\Model\HistoryData;
use App\Query\QueryHistory;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;

class QueryHistoryView implements QueryHistory
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(EntityManager $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function findLastAsset(string $asset): HistoryData
    {
        $row = $this->connection->fetchAssoc(
            'SELECT * FROM etf_history_data WHERE asset_code = :asset ORDER BY date_date DESC LIMIT 0, 1',
            [
                ':asset' => $asset
            ]
        );
        if (!$row) {
            throw new \DomainException("Asset does not exists.");
        }

        return new HistoryData(
            $row['asset_code'],
            new \DateTime($row['date_date']),
            $row['highPrice_value'],
            $row['lowPrice_value'],
            $row['openPrice_value'],
            $row['closePrice_value'],
            $row['volume_volume']);
    }
}