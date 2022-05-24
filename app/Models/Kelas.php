<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function kelas_detail()
    {
        return $this->hasMany(KelasDetail::class, 'id_kelas', 'id');
    }

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matkul', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
