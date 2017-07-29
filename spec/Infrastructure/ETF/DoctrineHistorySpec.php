<?php

namespace spec\Infrastructure\ETF;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Domain\ETF\History;
use Domain\ETF\Model\HistoryData;
use Domain\ETF\ValueObject\Asset;
use Domain\ETF\ValueObject\ClosePrice;
use Domain\ETF\ValueObject\Date;
use Domain\ETF\ValueObject\HighPrice;
use Domain\ETF\ValueObject\LowPrice;
use Domain\ETF\ValueObject\OpenPrice;
use Infrastructure\ETF\DoctrineHistory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoctrineHistorySpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
        $this->shouldImplement(History::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DoctrineHistory::class);
    }

    function it_adds_record_to_database(EntityManagerInterface $entityManager, EntityRepository $entityRepository)
    {
        $historyData = new HistoryData(new Date(new \DateTime('1989-11-23')), new Asset('ETFSP500'),
            new OpenPrice(11), new ClosePrice(11), new HighPrice(11), new LowPrice(11));
        $entityManager->getRepository(HistoryData::class)->willReturn($entityRepository);

        $entityRepository->findOneBy([
            'asset.code' => 'ETFSP500',
            'date.date' => $historyData->date()->date()
        ])->shouldBeCalled();

        $entityRepository->findOneBy([
            'asset.code' => 'ETFSP500',
            'date.date' => $historyData->date()->date()
        ])->willReturn(null);

        $entityManager->persist($historyData)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->add($historyData);
    }

    function it_finds_by_asset_and_date(EntityManagerInterface $entityManager, EntityRepository $entityRepository)
    {
        $date = new \DateTime('1989-11-23');
        $entityManager->getRepository(HistoryData::class)->willReturn($entityRepository);
        $entityRepository->findOneBy([
            'asset.code' => 'ETFSP500',
            'date.date' => $date,
        ])->shouldBeCalled();

        $this->findByAssetAndDate(new Asset('ETFSP500'), new Date($date));

    }
}
