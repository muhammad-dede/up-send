<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDetail extends Model
{
    use HasFactory;

    protected $table = 'absensi_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
