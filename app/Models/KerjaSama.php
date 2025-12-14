<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KerjaSama extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kerja_samas';

    protected $fillable = [
        'kode',
        'lembaga_mitra',
        'internasional',
        'nasional',
        'wilayah_lokal',
        'judul_kerja_sama',
        'manfaat',
        'dokumen',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'internasional' => 'boolean',
        'nasional' => 'boolean',
        'wilayah_lokal' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
    ];

    protected $appends = [
        'durasi',
        'start_date_indo',
        'end_date_indo',
    ];

    public function getStartDateIndoAttribute()
    {
        return $this->start_date ? Carbon::parse($this->start_date)->translatedFormat('d F Y') : null;
    }

    public function getEndDateIndoAttribute()
    {
        return $this->end_date ? Carbon::parse($this->end_date)->translatedFormat('d F Y') : null;
    }

    public function getDurasiAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $diff = $start->diff($end);

        $years = $diff->y;
        $months = $diff->m;

        if ($years > 0 && $months > 0) {
            return "{$years} tahun, {$months} bulan";
        } elseif ($years > 0) {
            return "{$years} tahun";
        } elseif ($months > 0) {
            return "{$months} bulan";
        }

        return "Kurang dari 1 bulan";
    }
}
