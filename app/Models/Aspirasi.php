<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasis';

    protected $fillable = [
        'nama',
        'nik',
        'telepon',
        'kelurahan',
        'kategori',
        'pesan',
        'status',
    ];
}
