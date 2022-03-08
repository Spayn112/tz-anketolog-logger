<?php

namespace Logger\Formatters;

use Logger\LogLevel;

/**
 * Форматтер, который преобразует сообщение в заданный формат с переносом строки
 */
class LineFormatter implements FormatterInterface
{
    public const DEFAULT_MESSAGE_FORMAT = '%date%  [%level_code%]  [%level%]  %message%';
    public const DEFAULT_DATE_FORMAT = 'Y-m-d H:i:s';

    private string $messageFormat;
    private string $dateFormat;

    public function __construct(?string $messageFormat = null, ?string $dateFormat = null)
    {
        if ($messageFormat === null) {
            $messageFormat = self::DEFAULT_MESSAGE_FORMAT;
        }
        if ($dateFormat === null) {
            $dateFormat = self::DEFAULT_DATE_FORMAT;
        }

        if (strpos($messageFormat, '%message%') === -1) {
            throw new \InvalidArgumentException('Message required in messageFormat template.');
        }
        $this->messageFormat = $messageFormat;
        $this->dateFormat = $dateFormat;
    }

    public function format(int $level, string $message): string
    {
        $formattedMessage = $this->messageFormat;

        $formattedMessage = str_replace('%date%', date($this->dateFormat), $formattedMessage);
        $formattedMessage = str_replace('%level_code%', str_pad($level, 3, 0, STR_PAD_LEFT), $formattedMessage);
        $formattedMessage = str_replace('%level%', LogLevel::getLabel($level), $formattedMessage);
        $formattedMessage = str_replace('%message%', $message, $formattedMessage);

        return $formattedMessage."\n";
    }
}
