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
        'description',
        'visi',
        'misi',
        'tujuan',
        'kurikulum',
        'profil_lulusan',
        'fasilitas',
        'order',
        'status',
    ];

    protected $casts = [
        'misi' => 'array',
        'tujuan' => 'array',
        'status' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'detail_url',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=002147&color=fff&size=512';
    }

    public function getDetailUrlAttribute(): string
    {
        return route('prodi-detail', $this->slug);
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
