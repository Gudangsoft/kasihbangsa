<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = [
        // Company Profile
        'company_name',
        'company_description',
        'company_address',
        'company_phone',
        'company_email',
        'company_website',
        'company_logo',
        // SEO Meta
        'meta_title',
        'meta_keywords',
        'meta_description',
        // Social Media
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'tiktok',
        // About Section
        'about_title',
        'about_subtitle',
        'about_description',
        'about_image',
        'about_video_url',
        // Stats Section
        'stat_programs',
        'stat_programs_label',
        'stat_students',
        'stat_students_label',
        'stat_lecturers',
        'stat_lecturers_label',
        'stat_accreditation',
        'stat_accreditation_label',
        // Contact Section
        'contact_title',
        'contact_subtitle',
        'contact_description',
        'contact_map_embed_url',
        // Footer
        'footer_description',
        'footer_copyright',
    ];

    protected $casts = [
        'stat_programs' => 'integer',
        'stat_students' => 'integer',
        'stat_lecturers' => 'integer',
    ];

    public static function getSettings()
    {
        return self::first() ?? new self();
    }

    // Accessor untuk backward compatibility dengan company()
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_name,
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_description,
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_address,
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_phone,
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_email,
        );
    }

    protected function website(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_website,
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->company_logo
                ? asset('storage/' . $this->company_logo)
                : 'https://ui-avatars.com/api/?name=' . urlencode($this->company_name ?? 'STP'),
        );
    }
}
