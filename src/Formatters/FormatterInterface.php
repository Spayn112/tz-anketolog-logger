<?php

namespace Logger\Formatters;

interface FormatterInterface
{
    public function format(int $level, string $message): string;
}
