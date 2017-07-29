<?php

declare(strict_types=1);

namespace Infrastructure\ETF;

use Doctrine\ORM\EntityManagerInterface;
use Domain\ETF\History;
use Domain\ETF\Model\HistoryData;
use Domain\ETF\ValueObject\Asset;
use Domain\ETF\ValueObject\Date;

class DoctrineHistory implements History
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(HistoryData $historyData): void
    {
        $record = $this->entityManager->getRepository(HistoryData::class)->findOneBy([
            'asset.code' => $historyData->asset()->code(),
            'date.date' => $historyData->date()->date()
        ]);

        if ($record) {
            return;
        }

        $this->entityManager->persist($historyData);
        $this->entityManager->flush();
    }

    public function findByAssetAndDate(Asset $asset, Date $date): ?HistoryData
    {
        $record = $this->entityManager->getRepository(HistoryData::class)->findOneBy([
            'asset.code' => $asset->code(),
            'date.date' => $date->date()
        ]);

        return $record;
    }
}
