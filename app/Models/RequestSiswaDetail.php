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
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo(RequestSiswa::class, 'request_siswa_id', 'id');
    }
}
