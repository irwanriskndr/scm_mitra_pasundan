<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "siswa";

    protected $fillable = [
        'jurusan_id',
        'nisn',
        'nama',
        'tgl_lahir',
        'alamat',
        'gender',
        'phone_number',
        'status',
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class, 'siswa_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }

    public function dokumenSiswas()
    {
        return $this->hasMany(DokumenSiswa::class, 'siswa_id', 'id');
    }
}
