<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laporan ;
use Illuminate\Support\Str;


class Mahasiswa extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nama','nim','email', 'user_id'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}