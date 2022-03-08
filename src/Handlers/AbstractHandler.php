<?php

namespace Logger\Handlers;

use Logger\AbstractLogger;
use Logger\Formatters\FormatterInterface;
use Logger\Formatters\LineFormatter;
use Logger\LogLevel;

/**
 * Абстрактный обработчик
 */
abstract class AbstractHandler extends AbstractLogger
{
    private bool $isEnabled = true;
    private array $levels = [];
    private FormatterInterface $formatter;

    public function __construct(array $config = [])
    {
        if (isset($config['is_enabled'])) {
            $this->isEnabled = $config['is_enabled'];
        }

        if (isset($config['levels'])) {
            $this->levels = $config['levels'];
        } else {
            $this->levels = LogLevel::getAllCodes();
        }

        if (isset($config['formatter'])) {
            $this->formatter = $config['formatter'];
        } else {
            $this->formatter = new LineFormatter();
        }
    }

    /**
     * Включение или отключение обработчика
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * Метод логгирует сообщение если обработчик включен и у него задан подходящий уровень логирования
     */
    public function log(int $level, string $message): void
    {
        if (! $this->isEnabled) {
            return;
        }
        if (! in_array($level, $this->levels)) {
            return;
        }
        $formattedMessage = $this->formatter->format($level, $message);

        $this->handle($level, $formattedMessage);
    }

    /**
     * Обрабатывает сообщение в конкретном обработчике
     */
    public abstract function handle(int $level, string $message): void;
}
