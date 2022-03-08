<?php

namespace Logger\Handlers;

/**
 * Обработчик, который записывает сообщение в файл
 */
class FileHandler extends AbstractHandler
{
    private string $filename;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if (! isset($config['filename'])) {
            throw new \InvalidArgumentException("Config must be contains filename.");
        }

        $this->filename = $config['filename'];
    }

    public function handle(int $level, string $message): void
    {
        file_put_contents($this->filename, $message, FILE_APPEND);
    }
}
