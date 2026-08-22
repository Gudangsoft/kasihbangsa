<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class ImportWordPressPosts extends Command
{
    protected $signature = 'import:wordpress-posts {--source=https://stiekasihbangsa.ac.id : Base URL of the WordPress site}';

    protected $description = 'Import all published posts from a WordPress REST API into the local posts table';

    protected array $categoryCache = [];

    public function handle(): int
    {
        $base = rtrim((string) $this->option('source'), '/');
        $endpoint = $base.'/wp-json/wp/v2/posts';

        $adminId = User::where('email', 'admin@stpdianmandala.local')->value('id')
            ?? User::query()->value('id');

        if (! $adminId) {
            $this->error('No user found to assign as post author.');

            return self::FAILURE;
        }

        $this->info("Fetching post list from {$endpoint} ...");

        $first = Http::timeout(30)->retry(3, 1000)->get($endpoint, [
            'per_page' => 100,
            'page' => 1,
            '_embed' => 1,
        ]);

        if ($first->failed()) {
            $this->error('Failed to reach WordPress REST API: HTTP '.$first->status());

            return self::FAILURE;
        }

        $totalPages = max(1, (int) $first->header('X-WP-TotalPages', 1));
        $totalPosts = (int) $first->header('X-WP-Total', count($first->json() ?? []));

        $this->info("Found {$totalPosts} posts across {$totalPages} page(s).");

        $created = 0;
        $updated = 0;
        $failed = 0;

        $bar = $this->output->createProgressBar($totalPosts);
        $bar->start();

        for ($page = 1; $page <= $totalPages; $page++) {
            $response = $page === 1
                ? $first
                : Http::timeout(30)->retry(3, 1000)->get($endpoint, [
                    'per_page' => 100,
                    'page' => $page,
                    '_embed' => 1,
                ]);

            if ($response->failed()) {
                $this->warn("\nFailed to fetch page {$page} (HTTP {$response->status()}), skipping.");

                continue;
            }

            foreach ($response->json() as $wpPost) {
                try {
                    $this->importPost($wpPost, $adminId) === 'created' ? $created++ : $updated++;
                } catch (Throwable $e) {
                    $failed++;
                    $this->warn("\nFailed to import '".($wpPost['slug'] ?? '?')."': ".$e->getMessage());
                }

                $bar->advance();
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done. Created: {$created}, Updated: {$updated}, Failed: {$failed}.");

        return self::SUCCESS;
    }

    protected function importPost(array $wpPost, int $adminId): string
    {
        $title = html_entity_decode(strip_tags($wpPost['title']['rendered'] ?? ''), ENT_QUOTES);
        $slug = $wpPost['slug'] ?: Str::slug($title);
        $content = $wpPost['content']['rendered'] ?? '';
        $excerpt = html_entity_decode(strip_tags($wpPost['excerpt']['rendered'] ?? ''), ENT_QUOTES);
        $preview = Str::limit(trim(preg_replace('/\s+/', ' ', $excerpt)), 250);

        $existing = Post::withTrashed()->where('slug', $slug)->first();

        $attributes = [
            'title' => $title ?: $slug,
            'preview' => $preview,
            'content' => $content,
            'publish_at' => $wpPost['date'] ?? now(),
            'category_id' => $this->resolveCategory($wpPost),
            'tags' => $this->resolveTags($wpPost),
            'status' => ($wpPost['status'] ?? 'publish') === 'publish',
            'created_by' => $adminId,
        ];

        if (! $existing || ! $existing->image) {
            if ($image = $this->downloadFeaturedImage($wpPost)) {
                $attributes['image'] = $image;
            }
        }

        if ($existing) {
            $existing->fill($attributes);

            if ($existing->trashed()) {
                $existing->restore();
            }

            $existing->save();

            return 'updated';
        }

        $attributes['slug'] = $slug;
        Post::create($attributes);

        return 'created';
    }

    protected function resolveCategory(array $wpPost): int
    {
        $name = 'Berita';

        foreach ($wpPost['_embedded']['wp:term'] ?? [] as $group) {
            foreach ($group as $term) {
                if (($term['taxonomy'] ?? null) === 'category' && ($term['name'] ?? 'Uncategorized') !== 'Uncategorized') {
                    $name = $term['name'];
                    break 2;
                }
            }
        }

        if (! isset($this->categoryCache[$name])) {
            $category = PostCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'status' => true]
            );
            $this->categoryCache[$name] = $category->id;
        }

        return $this->categoryCache[$name];
    }

    protected function resolveTags(array $wpPost): array
    {
        $tags = [];

        foreach ($wpPost['_embedded']['wp:term'] ?? [] as $group) {
            foreach ($group as $term) {
                if (($term['taxonomy'] ?? null) === 'post_tag') {
                    $tags[] = $term['name'];
                }
            }
        }

        return $tags;
    }

    protected function downloadFeaturedImage(array $wpPost): ?string
    {
        $media = $wpPost['_embedded']['wp:featuredmedia'][0] ?? null;

        if (! $media || isset($media['code']) || empty($media['source_url'])) {
            return null;
        }

        $url = $media['source_url'];

        try {
            $response = Http::timeout(30)->retry(2, 500)->get($url);
        } catch (Throwable) {
            return null;
        }

        if ($response->failed()) {
            return null;
        }

        $extension = pathinfo(parse_url($url, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION) ?: 'jpg';
        $filename = 'wp-'.$wpPost['id'].'-'.Str::random(6).'.'.$extension;
        $path = 'posts/images/'.$filename;

        Storage::disk('public')->put($path, $response->body());

        return $path;
    }
}
