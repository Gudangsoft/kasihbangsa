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
        'photo',
        'order',
        'status',
    ];

    protected $casts = [
        'riwayat_pendidikan' => 'array',
        'penelitian' => 'array',
        'pengabdian_masyarakat' => 'array',
        'capaian_khusus' => 'array',
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
