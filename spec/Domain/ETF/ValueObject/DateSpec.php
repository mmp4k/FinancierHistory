<?php

namespace spec\Domain\ETF\ValueObject;

use Domain\ETF\ValueObject\Date;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new \DateTime('23-11-1989'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Date::class);
    }

    function it_has_date()
    {
        $this->date()->shouldBeAnInstanceOf(\DateTime::class);
    }

    function it_returns_plain_date()
    {
        $this->plainDate()->shouldBe('1989-11-23');
    }

    function it_has_year()
    {
        $this->year()->shouldBe(1989);
    }

    function it_has_month()
    {
        $this->month()->shouldBe(11);
    }

    function it_has_day()
    {
        $this->day()->shouldBe(23);
    }

    function it_tells_it_is_business_day()
    {
        $this->isBusinessDay()->shouldBe(true);
    }
}
