<?php

return [
    "http://127.0.0.1:5500" => [
        "credentials" => true,
        "methods" => ['POST', 'GET', 'OPTIONS', 'DELETE', 'PUT'],
        "headers" => ['X-Requested-With', 'Content-Type', 'Origin', 'Authorization', 'Accept', 'Client-Security-Token', 'Accept-Encoding'],
        "contentType" => 'application/json; charset=utf-8'
    ],
];
