<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getWhatsappNumberAttribute(): string
    {
        $digits = preg_replace('/\D/', '', $this->phone ?? '');

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('floating_contacts');
        });

        static::deleted(function () {
            Cache::forget('floating_contacts');
        });
    }
}
