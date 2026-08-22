<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'slug', 'title', 'description', 'image_path', 'type', 'youtube_url'];
    protected $appends = [
        'thumbnail',
        'detail_url',
        'youtube_video_id',
        'youtube_embed_url',
        'youtube_thumbnail_url',
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id');
    }

    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    public function getThumbnailAttribute()
    {
        return null;
        // return $this->images()->latest()->first()['image'];
    }

    public function getDetailUrlAttribute()
    {
        return '/gallery/'.$this->slug;
    }

    public function getYoutubeVideoIdAttribute(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/', $this->youtube_url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        return $this->youtube_video_id
            ? 'https://www.youtube.com/embed/'.$this->youtube_video_id
            : null;
    }

    public function getYoutubeThumbnailUrlAttribute(): ?string
    {
        return $this->youtube_video_id
            ? 'https://img.youtube.com/vi/'.$this->youtube_video_id.'/hqdefault.jpg'
            : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($gallery) {
            $gallery->slug = Str::slug($gallery->title);
        });

        static::saved(function ($gallery) {
            if (request()->has('images')) {
                $gallery->images()->delete(); // Hapus gambar lama

                foreach (request()->input('images') as $image) {
                    $gallery->images()->create([
                        'image_path' => $image['image_path'],
                    ]);
                }
            }
        });
    }
}
