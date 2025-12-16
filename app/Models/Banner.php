<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['image_path'];

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image) ?? asset('assets') . '/images/backgrounds/slider-1-1.jpg';
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('slider_home_slides');
        });

        static::deleted(function () {
            Cache::forget('slider_home_slides');
        });
    }

}
