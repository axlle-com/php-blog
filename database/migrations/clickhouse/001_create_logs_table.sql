CREATE TABLE IF NOT EXISTS logs (
    method String,
    path String,
    fullUrl String,
    ip String,
    userAgent String,
    requestTime DateTime,
    duration Float64,
    host String,
    scheme String,
    contentType Nullable(String),
    contentLength Nullable(Int32),
    referer Nullable(String),
    userId Nullable(String),
    requestUuid String
) ENGINE = MergeTree()
ORDER BY requestTime;
