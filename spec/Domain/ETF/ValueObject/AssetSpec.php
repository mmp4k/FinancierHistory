<?php

namespace spec\Domain\ETF\ValueObject;

use Domain\ETF\ValueObject\Asset;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AssetSpec extends ObjectBehavior
{
    function let()
    {
        $code = 'ETFSP500';
        $this->beConstructedWith($code);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Asset::class);
    }

    function it_has_code()
    {
        $this->code()->shouldBe('ETFSP500');
    }
}
