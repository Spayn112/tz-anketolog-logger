<?php

namespace Logger;

class LogLevel
{
    public const LEVEL_ERROR = 1;
    public const LEVEL_INFO = 2;
    public const LEVEL_DEBUG = 3;
    public const LEVEL_NOTICE = 4;

    private static array $labels = [
        self::LEVEL_ERROR => 'ERROR',
        self::LEVEL_INFO => 'INFO',
        self::LEVEL_DEBUG => 'DEBUG',
        self::LEVEL_NOTICE => 'NOTICE'
    ];

    public static function getLabel(int $errorCode): string
    {
        $label = self::$labels[$errorCode] ?? null;

        if ($label === null) {
            throw new \InvalidArgumentException("Not found label for errorCode: $errorCode");
        }

        return $label;
    }

    public static function getAllCodes(): array
    {
        return array_keys(self::$labels);
    }
}
