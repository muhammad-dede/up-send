<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function absensi_detail()
    {
        return $this->hasMany(AbsensiDetail::class, 'id_absensi', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
