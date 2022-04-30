<?php

return [
    'session' => [
        'last_activity_minutes' => env('LAST_SESSION_ACTIVITY_MINUTES', 2)
    ],
    'character_limit' => env('CHARACTER_LIMIT', 160),
];
