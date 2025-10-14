<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa ;

class Laporan extends Model
{
use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'nomor_laporan', 'status', 'mahasiswa_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($laporan) {
            if ($laporan->isDirty('status')) {
                $laporan->tanggal_update_status_terakhir = now();
            }
        });
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class);
    }
}
