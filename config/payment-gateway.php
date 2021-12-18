<?php

return [
    "store" => [
        "id" => env('PAYMENT_GATEWAY_ID'),
        "secret" => env('PAYMENT_GATEWAY_SECRET'),
        "https" => env('PAYMENT_GATEWAY_HTTPS'),
    ],
    "base_url" => env('PAYMENT_GATEWAY_BASE'),
    "url" => [
        "initiate" => env('PAYMENT_GATEWAY_INITIATION_URL'),
        "status" => env('PAYMENT_GATEWAY_TX_STATUS_URL'),
        "validate" => env('PAYMENT_GATEWAY_VALIDATION_URL'),
    ],
    "api" => [
        "initiate" => env('PAYMENT_GATEWAY_BASE') . env('PAYMENT_GATEWAY_INITIATION_URL'),
        "status" => env('PAYMENT_GATEWAY_BASE') . env('PAYMENT_GATEWAY_TX_STATUS_URL'),
        "validate" => env('PAYMENT_GATEWAY_BASE') . env('PAYMENT_GATEWAY_VALIDATION_URL'),
    ]
];