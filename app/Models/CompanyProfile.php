<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'company_profiles';

    // Fillable fields
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'fb',
        'ig',
        'tiktok',
        'youtube',
        'twitter',
    ];

    public function getImageAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }
}
