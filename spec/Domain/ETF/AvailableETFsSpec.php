<?php

namespace spec\Domain\ETF;

use Domain\ETF\AvailableETFs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AvailableETFsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AvailableETFs::class);
    }

    function it_has_list_all_available_etfs()
    {
        self::list()->shouldBeArray();
    }
}
