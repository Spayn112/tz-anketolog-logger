<?php

namespace Logger;

use Logger\Handlers\AbstractHandler;

class Logger extends AbstractLogger
{
    /**
     * @var AbstractHandler[]
     */
    private array $handlers = [];

    public function addHandler(AbstractHandler $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function log(int $level, string $message): void
    {
        foreach ($this->handlers as $handler) {
            $handler->log($level, $message);
        }
    }
}
