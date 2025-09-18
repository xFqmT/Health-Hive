<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $table = 'pengunjung';
    protected $primaryKey = 'id_pengunjung';
    
    protected $fillable = [
        'tanggal',
        'nama',
        'kelas',    
        'angkatan',
        'jurusan',
        'keluhan',
        'terapi'
    ];

    // Optional: If you want to specify which fields should be cast to native types
    protected $casts = [
        'angkatan' => 'integer',
    ];

    // Optional: If you want to set default values
    protected $attributes = [
        'kelas' => null,
        'angkatan' => null,
        'jurusan' => null,
    ];
}