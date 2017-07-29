<?php

namespace spec\Domain\ETF\ValueObject;

use Domain\ETF\ValueObject\Volume;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VolumeSpec extends ObjectBehavior
{
    function let()
    {
        $volume = 100000;
        $this->beConstructedWith($volume);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Volume::class);
    }

    function it_has_value()
    {
        $this->value()->shouldBe(100000);
    }
}
