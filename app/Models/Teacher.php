<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'tb_guru';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'alamat',
        'agama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'created_at',
        'updated_at',
    ];
}
