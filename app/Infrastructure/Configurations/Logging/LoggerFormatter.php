<?php

namespace App\Infrastructure\Configurations\Logging;

use App\Shared\Enums\HttpHeadersEnum;
use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

class LoggerFormatter extends LineFormatter
{
    public function __construct()
    {
        parent::__construct("%message%", null, true, true);
    }

    public function format(LogRecord $record): string
    {
        return $this->convertToJson($record) . PHP_EOL;
    }
    private function convertToJson(LogRecord $record): string
    {
        $message = parent::format($record);

        return json_encode([
            'timestamp' => $record->datetime->format('Y-m-d H:i:s.u'),
            'level' => $record->level->getName(),
            'message' => $message,
            'traceId' => request()->headers->get(HttpHeadersEnum::X_TRACE_ID)
        ], JSON_UNESCAPED_UNICODE);
    }
}
