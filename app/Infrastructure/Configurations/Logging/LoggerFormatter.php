<?php

namespace App\Infrastructure\Configurations\Logging;

use App\Shared\Enums\HttpHeadersEnum;
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

        if(!request()->headers->has(HttpHeadersEnum::X_TRACE_ID)){
            request()->headers->set(HttpHeadersEnum::X_TRACE_ID, Str::uuid()->toString());
        }

        $jsonMessage = json_encode([
            'timestamp' => $record->datetime->format('Y-m-d H:i:s.u'),
            'level' => $record->level->getName(),
            'message' => $message,
            'traceId' => request()->headers->get(HttpHeadersEnum::X_TRACE_ID)
        ], JSON_UNESCAPED_UNICODE);

        return $jsonMessage . PHP_EOL;
    }
}
