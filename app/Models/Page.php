<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'file' => 'array',
    ];

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getAvatar($value)
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=305b90&background=e6eaf2';
    }

    public function getUrlAttribute()
    {
        $url = url('/page/'.$this->slug);
        return $url;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file) {
            if (is_array($this->file)) {
                return array_map(function ($file) {
                    return url('storage/' . $file);
                }, $this->file);
            }
            return url('storage/' . $this->file);
        }
        return null;
    }
}
