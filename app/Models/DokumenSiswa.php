<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class DokumenSiswa extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "dokumen_siswa";

    protected $fillable = [
        'siswa_id',
        'jenis',
        'url',
        'is_fetured'
    ];

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
