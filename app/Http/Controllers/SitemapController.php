<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Information;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = Cache::remember('sitemap_urls', now()->addHour(), function () {
            $urls = collect([
                ['loc' => url('/'), 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '1.0'],
                ['loc' => route('berita'), 'lastmod' => now(), 'changefreq' => 'daily', 'priority' => '0.8'],
                ['loc' => route('informasi'), 'lastmod' => now(), 'changefreq' => 'weekly', 'priority' => '0.7'],
                ['loc' => route('galleries'), 'lastmod' => now(), 'changefreq' => 'weekly', 'priority' => '0.6'],
                ['loc' => route('kerjasama'), 'lastmod' => now(), 'changefreq' => 'monthly', 'priority' => '0.5'],
                ['loc' => route('testimoni'), 'lastmod' => now(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ]);

            Post::where('status', true)->get(['slug', 'updated_at'])->each(function ($post) use ($urls) {
                $urls->push([
                    'loc' => route('detail-berita', $post->slug),
                    'lastmod' => $post->updated_at,
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ]);
            });

            Page::published()->get(['slug', 'updated_at'])->each(function ($page) use ($urls) {
                $urls->push([
                    'loc' => route('detail-page', $page->slug),
                    'lastmod' => $page->updated_at,
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ]);
            });

            Information::where('status', true)->get(['slug', 'updated_at'])->each(function ($information) use ($urls) {
                $urls->push([
                    'loc' => route('information-list', $information->slug),
                    'lastmod' => $information->updated_at,
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ]);
            });

            Gallery::get(['slug', 'updated_at'])->each(function ($gallery) use ($urls) {
                $urls->push([
                    'loc' => route('detail-gallery', $gallery->slug),
                    'lastmod' => $gallery->updated_at,
                    'changefreq' => 'monthly',
                    'priority' => '0.4',
                ]);
            });

            return $urls;
        });

        return Response::view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
    }
}
