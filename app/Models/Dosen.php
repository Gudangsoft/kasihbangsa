<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'nidn',
        'prodi',
        'jabatan_akademik',
        'jabatan_institusi',
        'status_dosen',
        'sertifikasi_dosen',
        'riwayat_pendidikan',
        'penelitian',
        'pengabdian_masyarakat',
        'capaian_khusus',
        'links',
        'photo',
        'order',
        'status',
    ];

    protected $casts = [
        'riwayat_pendidikan' => 'array',
        'penelitian' => 'array',
        'pengabdian_masyarakat' => 'array',
        'capaian_khusus' => 'array',
        'links' => 'array',
        'status' => 'boolean',
    ];

    protected $appends = [
        'photo_url',
        'detail_url',
    ];

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/'.$this->photo)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=002147&color=fff&size=256';
    }

    public function getDetailUrlAttribute(): string
    {
        return route('dosen-detail', $this->slug);
    }

    /**
     * Turns any bare URL inside a plain-text list item (e.g. a Google
     * Scholar profile pasted into "Penelitian") into a clickable link.
     */
    public static function linkify(string $text): string
    {
        return Str::of(e($text))
            ->replaceMatches(
                '/(https?:\/\/[^\s]+)/',
                fn ($match) => '<a href="'.$match[0].'" target="_blank" rel="noopener" class="text-primary-600 hover:underline break-all">'.$match[0].'</a>'
            )
            ->toString();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Dosen $dosen) {
            if (! $dosen->slug) {
                $dosen->slug = Str::slug($dosen->name);
            }
        });
    }
}
