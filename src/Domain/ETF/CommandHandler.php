<?php

declare(strict_types=1);

namespace Domain\ETF;

interface CommandHandler
{

    public function handle($argument1);
}
