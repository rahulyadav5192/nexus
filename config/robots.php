<?php

$disallow = env('ROBOTS_DISALLOW');

return [
    /*
    |--------------------------------------------------------------------------
    | Allow Search Engine Indexing
    |--------------------------------------------------------------------------
    |
    | When false, all crawlers are blocked from the entire site.
    | Defaults to true only when APP_ENV is production.
    |
    */
    'allow_indexing' => filter_var(
        env('ROBOTS_ALLOW_INDEXING', env('APP_ENV') === 'production'),
        FILTER_VALIDATE_BOOL
    ),

    'user_agents' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('ROBOTS_USER_AGENTS', '*'))
    ))),

    'disallow' => $disallow !== null && $disallow !== ''
        ? array_values(array_filter(array_map('trim', explode(',', $disallow))))
        : [
            '/web-admin',
            '/login',
            '/register',
            '/password',
            '/api',
            '/delete-all-data',
            '/test-meta',
        ],

    'allow' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('ROBOTS_ALLOW', ''))
    ))),

    'crawl_delay' => env('ROBOTS_CRAWL_DELAY'),

    'sitemap' => env('ROBOTS_SITEMAP_URL') ?: rtrim((string) env('APP_URL', ''), '/') . '/sitemap.xml',
];
