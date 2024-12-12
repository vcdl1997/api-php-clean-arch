<?php

namespace App\Shared\Enums;

enum HttpHeadersEnum: string
{
    // General Headers
    const ACCEPT = 'Accept';
    const ACCEPT_CHARSET = 'Accept-Charset';
    const ACCEPT_ENCODING = 'Accept-Encoding';
    const ACCEPT_LANGUAGE = 'Accept-Language';
    const CACHE_CONTROL = 'Cache-Control';
    const CONNECTION = 'Connection';
    const CONTENT_LENGTH = 'Content-Length';
    const CONTENT_TYPE = 'Content-Type';
    const DATE = 'Date';
    const PRAGMA = 'Pragma';
    const TRAILER = 'Trailer';
    const TRANSFER_ENCODING = 'Transfer-Encoding';
    const UPGRADE = 'Upgrade';
    const VIA = 'Via';
    const WARNING = 'Warning';

    // Request Headers
    const AUTHORIZATION = 'Authorization';
    const FROM = 'From';
    const HOST = 'Host';
    const IF_MATCH = 'If-Match';
    const IF_MODIFIED_SINCE = 'If-Modified-Since';
    const IF_NONE_MATCH = 'If-None-Match';
    const IF_RANGE = 'If-Range';
    const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';
    const MAX_FORWARDS = 'Max-Forwards';
    const PROXY_AUTHORIZATION = 'Proxy-Authorization';
    const RANGE = 'Range';
    const REFERER = 'Referer';
    const TE = 'TE';
    const USER_AGENT = 'User-Agent';

    // Response Headers
    const ACCEPT_RANGES = 'Accept-Ranges';
    const AGE = 'Age';
    const ETAG = 'ETag';
    const LOCATION = 'Location';
    const PROXY_AUTHENTICATE = 'Proxy-Authenticate';
    const RETRY_AFTER = 'Retry-After';
    const SERVER = 'Server';
    const VARY = 'Vary';
    const WWW_AUTHENTICATE = 'WWW-Authenticate';

    // CORS Headers
    const ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';
    const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';
    const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';
    const ACCESS_CONTROL_EXPOSE_HEADERS = 'Access-Control-Expose-Headers';
    const ACCESS_CONTROL_MAX_AGE = 'Access-Control-Max-Age';
    const ACCESS_CONTROL_REQUEST_METHOD = 'Access-Control-Request-Method';
    const ACCESS_CONTROL_REQUEST_HEADERS = 'Access-Control-Request-Headers';

    // Custom Headers
    const X_REQUESTED_WITH = 'X-Requested-With';
    const X_FRAME_OPTIONS = 'X-Frame-Options';
    const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';
    const X_XSS_PROTECTION = 'X-XSS-Protection';
    const X_FORWARDED_FOR = 'X-Forwarded-For';
    const X_FORWARDED_PROTO = 'X-Forwarded-Proto';
    const X_POWERED_BY = 'X-Powered-By';

    // Trace ID Headers
    const X_TRACE_ID = 'X-Trace-Id';
    const X_CORRELATION_ID = 'X-Correlation-Id';
}
