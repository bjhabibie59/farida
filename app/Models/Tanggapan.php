<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';

    protected $fillable = [
        'id_pengaduan',
        'tanggapan',
        'tgl_tanggapan',
        'id_user',
    ];

    /**
     * Mendefinisikan relasi ke User yang memberikan tanggapan.
     * Di view, ini akan diakses sebagai 'petugas'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
