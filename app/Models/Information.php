<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'description',
        'file',
        'status',
        'created_by',
    ];

    protected $appends = [
        'file_download',
        'date',
        'short_description'
    ];

    /**
     * Get the user that created the information.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(InformationCategory::class, 'category_id');
    }

    public function getFileDownloadAttribute()
    {
        return asset('storage').'/'.$this->file;
    }

    public function getDateAttribute(): ?string
    {
        $format = 'd-m-Y';
        return $this->created_at ? $this->created_at->format($format) : null;
    }

    public function getShortDescriptionAttribute()
    {
        $words = explode(' ', $this->description);

        if (count($words) > 10) {
            return implode(' ', array_slice($words, 0, 10)) . '...';
        }

        return $this->description;
    }

    // Optional: If you want to use Filament's HasSlug trait for automatic slug generation
    // use \Illuminate\Support\Str;
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => ['source' => 'title']
    //     ];
    // }
}
