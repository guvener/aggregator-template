<?php

return [

    /*
    |
    |  Social API Keys and services
    |
     */
    'flickr_api_key' => env('FLICKR_KEY'),
    'tumblr_api_key' => env('TUMBLR_KEY'),
    'pusher' => [
        'api_key' => env('PUSHER_KEY'),
        'secret' => env('PUSHER_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
    ],
    'pusher_enabled' => env('PUSHER_ENABLED', false),
    /*
    Available Channel Types
     */
    'channels' => [
        'flickr' => ['hashtag'],
        'tumblr' => ['hashtag'],
    ],
    /*
    |--------------------------------------------------------------------------
    |  Configuration : Channels Prefix
    |--------------------------------------------------------------------------
    |
    | Main prefix for channels.
    |
     */
    'channel_path' => 'channels',

];
