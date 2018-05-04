<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Home URL to the store you want to connect to here
    |--------------------------------------------------------------------------
    */
    'store_url' => env('WOOCOMMERCE_STORE_URL', 'http://localhost/coupon/'),

    /*
    |--------------------------------------------------------------------------
    | Consumer Key
    |--------------------------------------------------------------------------
    */
    'consumer_key' => env('WOOCOMMERCE_CONSUMER_KEY', 'ck_f54cb58a88c6ad3124222cbc35a39a47f5feb2ad'),

    /*
    |--------------------------------------------------------------------------
    | Consumer Secret
    |--------------------------------------------------------------------------
    */
    'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET', 'cs_ac71cd3d138b04e9268913d7d32b63b4975eb3ca'),

    /*
    |--------------------------------------------------------------------------
    | SSL support
    |--------------------------------------------------------------------------
    */
    'verify_ssl' => env('WOOCOMMERCE_VERIFY_SSL', false),

    /*
    |--------------------------------------------------------------------------
    | API version
    |--------------------------------------------------------------------------
    */
    'api_version' => env('WOOCOMMERCE_VERSION', 'v2'),

    /*
    |--------------------------------------------------------------------------
    | WP API usage
    |--------------------------------------------------------------------------
    */
    'wp_api' => env('WOOCOMMERCE_WP_API', true),

    /*
    |--------------------------------------------------------------------------
    | Force Basic Authentication as query string
    |--------------------------------------------------------------------------
    */
    'query_string_auth' => env('WOOCOMMERCE_WP_QUERY_STRING_AUTH', false),

    /*
    |--------------------------------------------------------------------------
    | WP timeout
    |--------------------------------------------------------------------------
    */
    'timeout' => env('WOOCOMMERCE_WP_TIMEOUT', 60),
];