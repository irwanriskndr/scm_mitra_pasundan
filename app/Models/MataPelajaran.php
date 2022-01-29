<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "mata_pelajaran";

    protected $fillable = [
        'nama',
        'nilai',
        'semester_id',
    ];
}
