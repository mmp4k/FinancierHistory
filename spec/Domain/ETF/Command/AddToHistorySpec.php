<?php

namespace spec\Domain\ETF\Command;

use Domain\ETF\Command\AddToHistory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddToHistorySpec extends ObjectBehavior
{
    function let()
    {
        $code = 'ETFSP500';
        $openPrice = 12.12;
        $closePrice = 12.13;
        $highPrice = 13.13;
        $lowPrice = 11.11;
        $date = '1989-11-23';
        $this->beConstructedWith($code, $date, $openPrice, $closePrice, $highPrice, $lowPrice);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddToHistory::class);
    }

    function it_returns_code()
    {
        $this->code()->shouldBe('ETFSP500');
    }

    function it_returns_open_price()
    {
        $this->openPrice()->shouldBe(12.12);
    }

    function it_returns_close_price()
    {
        $this->closePrice()->shouldBe(12.13);
    }

    function it_returns_high_price()
    {
        $this->highPrice()->shouldBe(13.13);
    }

    function it_returns_low_price()
    {
        $this->lowPrice()->shouldBe(11.11);
    }

    function it_returns_date()
    {
        $this->date()->shouldBe('1989-11-23');
    }
}
