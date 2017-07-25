<?php

return [

    /*
    |
    |  Social API Keys and services
    |
     */
    'flickr_api_key' => '',
    'tumblr_api_key' => '',
    'pusher' => [
        'api_key' => '',
        'secret' => '',
        'app_id' => '',
    ],
    'pusher_enabled' => false,

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
