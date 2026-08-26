<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProgramStudi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'jenjang',
        'gelar',
        'akreditasi',
        'akreditasi_sk',
        'image',
        'images',
        'description',
        'visi',
        'misi',
        'tujuan',
        'kurikulum',
        'profil_lulusan',
        'fasilitas',
        'instagram',
        'facebook',
        'youtube',
        'tiktok',
        'order',
        'status',
    ];

    protected $casts = [
        'misi' => 'array',
        'tujuan' => 'array',
        'images' => 'array',
        'status' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'detail_url',
        'image_urls',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=002147&color=fff&size=512';
    }

    public function getImageUrlsAttribute(): array
    {
        return collect($this->images ?? [])
            ->map(fn ($path) => asset('storage/'.$path))
            ->all();
    }

    public function getDetailUrlAttribute(): string
    {
        return route('prodi-detail', $this->slug);
    }

    /**
     * Parses the free-text "fasilitas" rich content into a flat list of
     * facility names, so the public page can render icon cards instead of
     * raw prose. Falls back to an empty array if nothing list-like is found.
     */
    public function getFasilitasListAttribute(): array
    {
        if (! $this->fasilitas) {
            return [];
        }

        if (preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $this->fasilitas, $matches)) {
            $items = $matches[1];
        } else {
            $items = preg_split('/<\/p>|<br\s*\/?>/i', $this->fasilitas);
        }

        return collect($items)
            ->map(fn ($item) => trim(html_entity_decode(strip_tags($item))))
            ->filter(fn ($item) => $item !== '')
            ->values()
            ->all();
    }

    public function dosens()
    {
        return Dosen::where('status', true)
            ->where('prodi', $this->name)
            ->orderBy('order')
            ->get();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ProgramStudi $prodi) {
            if (! $prodi->slug) {
                $prodi->slug = Str::slug($prodi->name);
            }
        });
    }
}
