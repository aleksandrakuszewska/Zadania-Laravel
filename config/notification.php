<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Notification Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the default notification channel that is used
    | to send notifications. The value should be a channel defined in
    | the "channels" configuration array below.
    |
    */

    'default' => env('NOTIFICATION_CHANNEL', 'mail'),

    /*
    |--------------------------------------------------------------------------
    | Notification Channels
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the notification channels that are supported
    | by your application. Out of the box, Laravel supports 'mail', 'database',
    | 'broadcast', 'nexmo', 'slack', and 'sms' as notification channels.
    |
    */

    'channels' => [
        'mail' => [
            'driver' => 'mail',
            'queue' => true,
        ],
    ],
];
