<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';
    protected $fillable = [
        'user_id',
        'nama',
        'nis',
        'alamat',
        'agama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'rombel_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Kelas::class, 'rombel_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id', 'siswa_id');
    }
}
