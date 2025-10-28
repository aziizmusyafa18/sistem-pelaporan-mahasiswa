<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laporan ;


class Mahasiswa extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nama','nim','email'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}