<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSiswaDetail extends Model
{
    use HasFactory;

    public $table = "request_siswa_details";

    protected $fillable = [
        'user_id',
        'siswa_id',
        'request_siswa_id',
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }
}
