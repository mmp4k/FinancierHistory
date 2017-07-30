<?php

declare(strict_types=1);

namespace Domain\ETF;

use Domain\ETF\Command\AddToHistory;

class Importer
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function import(string $code, array $linesInFile): void
    {
        foreach ($linesInFile as $i => $line) {
            if ($i === 0) {
                continue;
            }
            list($date, $open, $high, $low, $close, $volume) = explode(',', $line);
            $date = \DateTime::createFromFormat('Ymd', $date);

            $this->commandBus->handle(new AddToHistory(
                $code,
                $date->format('Y-m-d'),
                (float)$open,
                (float)$close,
                (float)$high,
                (float)$low,
                (int)$volume));
        }

    }
}
