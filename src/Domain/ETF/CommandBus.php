<?php

declare(strict_types=1);

namespace Domain\ETF;

interface CommandBus
{
    public function handle(Command $command) : void;
    public function registerHandler(string $class, $handler) : void;
}
