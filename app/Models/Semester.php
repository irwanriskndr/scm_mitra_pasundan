<?php

namespace App\Models;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    public $table = "semester";

    protected $fillable = [
        'siswa_id',
        'semester_ke',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'semester_id', 'id');
    }
}
