<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';

    protected $fillable = [
        'id_pengaduan',
        'tanggapan',
        'tanggal_tanggapan'
    ];

    public $timestamps = false;
}
