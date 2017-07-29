<?php

namespace spec\Domain\ETF;

use Domain\ETF\Command\AddToHistory;
use Domain\ETF\Importer;
use Domain\ETF\CommandBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImporterSpec extends ObjectBehavior
{
    function let(CommandBus $commandBus)
    {
        $this->beConstructedWith($commandBus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Importer::class);
    }

    function it_imports_data(CommandBus $commandBus)
    {
        $commandBus->handle(Argument::type(AddToHistory::class))->shouldBeCalled();

        $this->import('ETFSP500', [[], '20181123,12,12,12,12,1']);
    }
}
