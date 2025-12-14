<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = [
        'about_title',
        'about_subtitle',
        'about_description',
        'about_image',
        'about_video_url',
        'stat_programs',
        'stat_programs_label',
        'stat_students',
        'stat_students_label',
        'stat_lecturers',
        'stat_lecturers_label',
        'stat_accreditation',
        'stat_accreditation_label',
        'contact_title',
        'contact_subtitle',
        'contact_description',
        'map_embed_url',
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
}
