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
        contentLength Nullable(String),
        referer Nullable(String),
        queryParams JSON,
        requestBody JSON,
        headers JSON,
        data JSON,
    ) ENGINE = MergeTree()
ORDER BY requestTime;
