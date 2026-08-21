<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class QuickLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('home_quick_links');
        });

        static::deleted(function () {
            Cache::forget('home_quick_links');
        });
    }
}
