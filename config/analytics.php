<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Analytics 4 Property ID
    |--------------------------------------------------------------------------
    |
    | The property ID from your Google Analytics 4 property.
    | Format: properties/XXXXXXXXXX
    |
    */
    'property_id' => env('GA4_PROPERTY_ID'),

    /*
    |--------------------------------------------------------------------------
    | Service Account Credentials Path
    |--------------------------------------------------------------------------
    |
    | Path to the service account JSON credentials file.
    | Default: storage/app/analytics/service-account.json
    |
    */
    'credentials_path' => env('GA4_CREDENTIALS_PATH', storage_path('app/analytics/service-account.json')),

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Cache duration for analytics data in minutes.
    | Set to 0 to disable caching.
    |
    */
    'cache_duration' => env('GA4_CACHE_DURATION', 60),
];