<?php

namespace Logger\Handlers;

use Logger\LogLevel;

/**
 * Обработчик, который записывает сообщение в системный журнал
 */
class SysLogHandler extends AbstractHandler
{
    private array $logLevelMap = [
        LogLevel::LEVEL_ERROR => LOG_ERR,
        LogLevel::LEVEL_INFO => LOG_INFO,
        LogLevel::LEVEL_DEBUG => LOG_DEBUG,
        LogLevel::LEVEL_NOTICE => LOG_NOTICE
    ];

    private int $defaultLevel = LOG_INFO;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if (isset($config['log_level_map'])) {
            $this->logLevelMap = $config['log_level_map'];
        }
        if (isset($config['default_Level'])) {
            $this->defaultLevel = $config['default_Level'];
        }
    }

    public function handle(int $level, string $message): void
    {
        syslog($this->convertLogLevel($level), $message);
    }

    /**
     * Преобразует внутренний уровень логгирования в уровень логгирования функции syslog()
     */
    private function convertLogLevel(int $level): int
    {
        return $this->logLevelMap[$level] ?? $this->defaultLevel;
    }
}
