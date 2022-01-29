<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestSiswa extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "request_siswa";

    protected $fillable = [
        'deskripsi',
        'jumlah',
        'status',
        'user_id',
    ];

    public function requestDetails()
    {
        return $this->hasMany(RequestSiswaDetail::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
