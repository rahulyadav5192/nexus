<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $config = config('robots');
        $lines = [];

        if (!$config['allow_indexing']) {
            $lines[] = 'User-agent: *';
            $lines[] = 'Disallow: /';

            return $this->plainTextResponse($lines);
        }

        foreach ($config['user_agents'] as $userAgent) {
            $lines[] = 'User-agent: ' . $userAgent;

            foreach ($config['disallow'] as $path) {
                $lines[] = 'Disallow: ' . $this->normalizePath($path);
            }

            foreach ($config['allow'] as $path) {
                $lines[] = 'Allow: ' . $this->normalizePath($path);
            }

            if (!empty($config['crawl_delay'])) {
                $lines[] = 'Crawl-delay: ' . $config['crawl_delay'];
            }

            $lines[] = '';
        }

        if (!empty($config['sitemap'])) {
            $lines[] = 'Sitemap: ' . $config['sitemap'];
        }

        return $this->plainTextResponse($lines);
    }

    private function plainTextResponse(array $lines): Response
    {
        $content = rtrim(implode("\n", $lines)) . "\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    private function normalizePath(string $path): string
    {
        if ($path === '' || $path === '/') {
            return '/';
        }

        return '/' . ltrim($path, '/');
    }
}
