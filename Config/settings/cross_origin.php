<?php

return [
    "http://localhost:4200" => [
        "credentials" => true,
        "methods" => ['POST', 'GET', 'OPTIONS', 'DELETE', 'PUT'],
        "headers" => ['X-Requested-With', 'Content-Type', 'Origin', 'Authorization', 'Accept', 'Client-Security-Token', 'Accept-Encoding'],
        "contentType" => 'application/json; charset=utf-8'
    ],
];
