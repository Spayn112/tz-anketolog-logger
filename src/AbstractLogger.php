<?php

namespace Logger;

/**
 * Абстрактный логгер унифицирующий интерфейс
 */
abstract class AbstractLogger
{
    public abstract function log(int $level, string $message): void;

    public function error(string $message): void
    {
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }

    public function info(string $message): void
    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }

    public function debug(string $message): void
    {
        $this->log(LogLevel::LEVEL_DEBUG, $message);
    }

    public function notice(string $message): void
    {
        $this->log(LogLevel::LEVEL_NOTICE, $message);
    }
}
