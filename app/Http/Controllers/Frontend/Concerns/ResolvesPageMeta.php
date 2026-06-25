<?php

namespace App\Http\Controllers\Frontend\Concerns;

use App\Models\MetaTags;

trait ResolvesPageMeta
{
    protected function pageMeta(string $pageKey): ?MetaTags
    {
        $page = config("nexus_pages.{$pageKey}");

        return $page ? MetaTags::forPage($page) : null;
    }
}
