<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'ai' => [
        'driver' => env('AI_DRIVER', 'ollama'),
    ],

    'ollama' => [
        'url' => env('OLLAMA_URL', 'http://localhost:11434'),
        'model' => env('OLLAMA_MODEL', 'qwen2.5:7b'),
    ],

    'gemini' => [
        'api_key' => trim((string) env('GEMINI_API_KEY', '')),
        'model' => env('GEMINI_MODEL', 'gemini-2.0-flash'),
    ],

    'huggingface' => [
        'token' => trim((string) env('HUGGINGFACE_TOKEN', '')),
        'model' => env('HUGGINGFACE_MODEL', 'Qwen/Qwen2.5-7B-Instruct'),
        'base_url' => env('HUGGINGFACE_BASE_URL', 'https://router.huggingface.co/models'),
    ],

];
