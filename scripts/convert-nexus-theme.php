<?php

$viewsDir = dirname(__DIR__) . '/resources/views';
$srcDir = $viewsDir . '/nexus /';
$outDir = dirname(__DIR__) . '/resources/views/frontend/nexus';

if (!is_dir($outDir)) {
    mkdir($outDir, 0755, true);
}

$routeMap = [
    'index.html' => "{{ route('home') }}",
    'about.html' => "{{ route('about') }}",
    'companies.html' => "{{ route('companies') }}",
    'operations.html' => "{{ route('operations') }}",
    'expansion.html' => "{{ route('expansion') }}",
    'investors.html' => "{{ route('investors') }}",
    'blog.html' => "{{ route('blogs') }}",
    'blog-post.html' => "{{ route('blogs') }}",
    'careers.html' => "{{ route('careers') }}",
    'contact.html' => "{{ route('contactus') }}",
    'leadership.html' => "{{ route('leadership') }}",
    'privacy.html' => "{{ route('privacyPolicy') }}",
    'terms.html' => "{{ route('termsAndConditions') }}",
    'disclosures.html' => "{{ route('disclosures') }}",
];

$pageMap = [
    'index' => 'home',
    'about' => 'about',
    'companies' => 'companies',
    'operations' => 'operations',
    'expansion' => 'expansion',
    'investors' => 'investors',
    'blog' => 'blogs',
    'blog-post' => 'blogs',
    'careers' => 'careers',
    'contact' => 'contactus',
    'leadership' => 'leadership',
    'privacy' => 'privacy',
    'terms' => 'terms',
    'disclosures' => 'disclosures',
];

function transformContent(string $content): string
{
    global $routeMap;

    $content = preg_replace('/src="([^"\/][^"]*\.webp)"/', "src=\"{{ asset('nexus/images/$1') }}\"", $content);
    $content = str_replace('src="empty.vtt"', "src=\"{{ asset('nexus/empty.vtt') }}\"", $content);

    foreach ($routeMap as $html => $route) {
        $content = str_replace('href="' . $html . '"', 'href="' . $route . '"', $content);
    }

    return $content;
}

$files = array_filter(
    scandir($srcDir) ?: [],
    fn ($file) => str_ends_with($file, '.html')
);
$files = array_map(fn ($file) => $srcDir . $file, $files);
foreach ($files as $file) {
    $basename = basename($file, '.html');
    $html = file_get_contents($file);

    preg_match('/<title>(.*?)<\/title>/s', $html, $titleMatch);
    preg_match('/<meta name="description" content="(.*?)"/s', $html, $descMatch);

    $title = html_entity_decode(strip_tags($titleMatch[1] ?? 'Nexus Group Holdings'), ENT_QUOTES, 'UTF-8');
    $description = html_entity_decode($descMatch[1] ?? '', ENT_QUOTES, 'UTF-8');

    $pageStyles = '';
    if (preg_match('/<style>(.*?)<\/style>/s', $html, $styleMatch)) {
        $pageStyles = trim($styleMatch[1]);
    }

    $pageScripts = '';
    if (preg_match('/<script src="main\.js"><\/script>\s*(<script>.*?<\/script>)/s', $html, $scriptMatch)) {
        $pageScripts = trim($scriptMatch[1]);
    }

    $startMarker = '</div>';
    $footerPos = stripos($html, '<footer');
    $mobileMenuPos = stripos($html, 'class="mobile-menu"');
    $contentStart = false;

    if ($mobileMenuPos !== false) {
        $mobileMenuEnd = strpos($html, '</div>', $mobileMenuPos);
        if ($mobileMenuEnd !== false) {
            $contentStart = $mobileMenuEnd + strlen('</div>');
        }
    }

    if ($contentStart === false || $footerPos === false) {
        echo "Skipping {$basename}: could not extract content\n";
        continue;
    }

    $bodyContent = trim(substr($html, $contentStart, $footerPos - $contentStart));
    $bodyContent = transformContent($bodyContent);

    $activePage = $pageMap[$basename] ?? '';

    $blade = "@extends('layouts.nexus')\n\n";
    $blade .= "@section('title', " . var_export($title, true) . ")\n";
    if ($description !== '') {
        $blade .= "@section('meta_description', " . var_export($description, true) . ")\n";
    }
    $blade .= "@section('active_page', " . var_export($activePage, true) . ")\n\n";

    if ($pageStyles !== '') {
        $blade .= "@section('page_styles')\n<style>\n{$pageStyles}\n</style>\n@endsection\n\n";
    }

    $blade .= "@section('content')\n{$bodyContent}\n@endsection\n";

    if ($pageScripts !== '') {
        $blade .= "\n@section('page_scripts')\n{$pageScripts}\n@endsection\n";
    }

    file_put_contents($outDir . '/' . $basename . '.blade.php', $blade);
    echo "Created {$basename}.blade.php\n";
}

echo "Done.\n";
