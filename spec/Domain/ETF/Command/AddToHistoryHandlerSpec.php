<?php

namespace spec\Domain\ETF\Command;

use Domain\ETF\Command\AddToHistory;
use Domain\ETF\Command\AddToHistoryHandler;
use Domain\ETF\History;
use Domain\ETF\Model\HistoryData;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophet;

class AddToHistoryHandlerSpec extends ObjectBehavior
{
    function let(History $history)
    {
        $this->beConstructedWith($history);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddToHistoryHandler::class);
    }

    function it_handles_only_add_to_history_command(History $history)
    {
        $history->add(Argument::type(HistoryData::class))->shouldBeCalled();

        $command = new AddToHistory('ETF', '1989-11-23', 11.11, 11.12, 11.13, 11.14);
        $this->handle($command);
    }
}
