<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajar extends Model
{
    use HasFactory;

    protected $table = 'tb_ajar';
    protected $guarded = [];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function rombel()
    {
        return $this->belongsTo(Kelas::class, 'rombel_id');
    }

    public function pengajar()
    {
        return $this->belongsTo(Teacher::class, 'pengajar_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'jadwal_id', 'id');
    }
}
