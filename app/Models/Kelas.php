<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_kelas';

    protected $guarded = [];

    public function walikelas()
    {
        return $this->belongsTo(Teacher::class, 'wali_kelas', 'user_id');
    }

    public function ketuakelas()
    {
        return $this->belongsTo(Student::class, 'ketua_kelas', 'user_id');
    }

    public function siswa()
    {
        return $this->hasMany(Student::class, 'rombel_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasMany(Ajar::class, 'rombel_id');
    }
}
