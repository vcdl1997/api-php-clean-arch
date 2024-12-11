<?php

namespace App\Infrastructure\Configurations\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;
use Illuminate\Support\Str;

class LoggerFormatter extends LineFormatter
{
    public function __construct()
    {
        parent::__construct("%message%", null, true, true);
    }

    public function format(LogRecord $record): string
    {
        $message = parent::format($record);
        $message = mb_convert_encoding($message, 'UTF-8', 'UTF-8');

        if(!request()->headers->has("traceId")){
            request()->headers->set("traceId", Str::uuid()->toString());
        }

        $jsonMessage = json_encode([
            'timestamp' => $record->datetime->format('Y-m-d H:i:s.u'),
            'level' => $record->level,
            'message' => $message,
            'traceId' => request()->headers->get('traceId')
        ], JSON_UNESCAPED_UNICODE);

        return $jsonMessage . PHP_EOL;
    }
}
