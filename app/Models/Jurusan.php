<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "jurusan";

    protected $fillable = [
        'nama',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'jurusan_id', 'id');
    }

    // public function jurusans()
    // {
    //     return $this->hasMany(Semester::class, 'semester_id', 'id');
    // }
}
