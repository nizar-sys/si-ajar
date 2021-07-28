<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'tb_absensi';

    protected $fillable = [
        'jadwal_id',
        'siswa_id',
        'jam_absen',
        'keterangan'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Ajar::class, 'jadwal_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'siswa_id', 'id');
    }
}
