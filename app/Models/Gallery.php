<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'slug', 'title', 'description', 'image_path'];
    protected $appends = [
        'thumbnail',
        'detail_url',
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id');
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
