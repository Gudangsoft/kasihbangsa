<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($gallery) {
            $gallery->slug = Str::slug($gallery->name);
        });

    }
}
