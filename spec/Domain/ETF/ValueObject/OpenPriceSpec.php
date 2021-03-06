<?php

namespace spec\Domain\ETF\ValueObject;

use Domain\ETF\ValueObject\OpenPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OpenPriceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OpenPrice::class);
    }

    function let()
    {
        $price = 123;
        $this->beConstructedWith($price);
    }

    function it_counts_polish_zloty()
    {
        $this->zloty()->shouldBe(1.23);
        $this->zloty()->shouldBeFloat();
    }

    function it_has_value()
    {
        $this->value()->shouldBe(123);
        $this->value()->shouldBeInt();
    }
}
