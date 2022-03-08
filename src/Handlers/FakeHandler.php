<?php

namespace Logger\Handlers;

/**
 * Обработчик который ничего не делает
 */
class FakeHandler extends AbstractHandler
{
    public function handle(int $level, string $message): void
    {
    }
}
