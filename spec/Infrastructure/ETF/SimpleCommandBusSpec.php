<?php

namespace spec\Infrastructure\ETF;

use Domain\ETF\CommandBus;
use Domain\ETF\Command;
use Domain\ETF\CommandHandler;
use Infrastructure\ETF\SimpleCommandBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleCommandBusSpec extends ObjectBehavior
{
    function let()
    {
        $this->shouldImplement(CommandBus::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SimpleCommandBus::class);
    }

    function it_register_handlers(CommandHandler $handler, Command $command)
    {
        $this->registerHandler(get_class($command), $handler);
    }

    function it_handles(CommandHandler $handler, Command $command)
    {
        $handler->handle($command->getWrappedObject())->shouldBeCalled();

        $this->registerHandler(get_class($command->getWrappedObject()), $handler);
        $this->handle($command->getWrappedObject());

    }
}
