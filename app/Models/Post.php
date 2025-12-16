<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'preview',
        'content',
        'image',
        'publish_at',
        'category_id',
        'tags',
        'status',
        'created_by',
    ];

    protected $casts = [
        'tags' => 'array',
        'status' => 'boolean',
        'publish_at' => 'datetime',
    ];

    protected $appends = [
        'thumbnail',
        'read_url',
        'date_time',
        'tag',
    ];

    public function contentPreview(int $maxWords = 30)
    {
        $words = explode(' ', $this->preview);

        if (count($words) > $maxWords) {
            return implode(' ', array_slice($words, 0, $maxWords)) . '...';
        }

        return $this->preview;
    }

    public function relatedPosts()
    {
        return $this->hasMany(Post::class, 'created_by', 'created_by')
            ->where('id', '!=', $this->id) // Hindari artikel yang sama
            ->where('status', true) // Pastikan hanya yang aktif
            ->latest(); // Urutkan berdasarkan terbaru
    }

    public function date(string $format = 'Y-m-d H:i:s'): ?string
    {
        return $this->publish_at ? $this->publish_at->format($format) : null;
    }

    public function getDateTimeAttribute(): ?string
    {
        $format = 'd-m-Y H:i';
        return $this->publish_at ? $this->publish_at->format($format) : null;
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getThumbnailAttribute()
    {
        return $this->image != null ? asset('storage/' . $this->image) : asset('assets') . '/images/blogs/04.png';
    }

    public function getReadUrlAttribute()
    {
        return route('detail-berita', $this->slug);
    }

    public function getTagAttribute()
    {
        if (!$this->tags) {
            return '';
        }

        return collect($this->tags)->unique()->map(function ($tag) {
            return "<a href='/berita?tag={$tag}' class='tag-link'>{$tag}</a>";
        })->implode(' ');
    }
}
