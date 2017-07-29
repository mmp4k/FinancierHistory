<?php

namespace spec\Domain\ETF\Model;

use Domain\ETF\Model\HistoryData;
use Domain\ETF\ValueObject\Asset;
use Domain\ETF\ValueObject\ClosePrice;
use Domain\ETF\ValueObject\Date;
use Domain\ETF\ValueObject\HighPrice;
use Domain\ETF\ValueObject\LowPrice;
use Domain\ETF\ValueObject\OpenPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidInterface;

class HistoryDataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new Date(new \DateTime('23-11-2019')),
            new Asset('ETFSP500'),
            new OpenPrice(231),
            new ClosePrice(235),
            new HighPrice(245),
            new LowPrice(120));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HistoryData::class);
    }

    function it_has_uuid()
    {
        $this->uuid()->shouldBeAnInstanceOf(UuidInterface::class);
    }

    function it_has_date()
    {
        $this->date()->shouldBeAnInstanceOf(Date::class);
    }

    function it_has_open_price()
    {
        $this->openPrice()->shouldBeAnInstanceOf(OpenPrice::class);
    }

    function it_has_close_price()
    {
        $this->closePrice()->shouldBeAnInstanceOf(ClosePrice::class);
    }

    function it_has_high_price()
    {
        $this->highPrice()->shouldBeAnInstanceOf(HighPrice::class);
    }

    function it_has_low_price()
    {
        $this->lowPrice()->shouldBeAnInstanceOf(LowPrice::class);
    }

    function it_represents_asset()
    {
        $this->asset()->shouldBeAnInstanceOf(Asset::class);
    }
}
