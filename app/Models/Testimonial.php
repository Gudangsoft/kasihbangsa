<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo_profile',
        'description',
        'status',
        'rate',
    ];

    protected $appends = [
        'avatar',
    ];

    public function getAvatarAttribute()
    {
        // dd($this->profile_photo_path);
        return $this->photo_profile ? asset('storage/' . $this->photo_profile) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($testimoni) {
            if (empty($testimoni->slug)) {
                $testimoni->slug = Str::slug($testimoni->name);
            }
        });

        static::updating(function ($testimoni) {
            if (empty($testimoni->slug)) {
                $testimoni->slug = Str::slug($testimoni->name);
            }
        });
    }
}
