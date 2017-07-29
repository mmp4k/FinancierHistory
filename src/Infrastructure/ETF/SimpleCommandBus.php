<?php

declare(strict_types=1);

namespace Infrastructure\ETF;

use Domain\ETF\Command;
use Domain\ETF\CommandBus;
use Domain\ETF\CommandHandler;

class SimpleCommandBus implements CommandBus
{
    protected $handlers = [];

    public function handle(Command $command): void
    {
        if (!isset($this->handlers[get_class($command)])) {
            return;
        }

        $this->handlers[get_class($command)]->handle($command);
    }

    public function registerHandler(string $class, $handler): void
    {
        $this->handlers[$class] = $handler;
    }
}
