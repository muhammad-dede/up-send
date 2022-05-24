<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasDetail extends Model
{
    use HasFactory;

    protected $table = 'kelas_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
