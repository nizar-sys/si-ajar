<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_mapel';

    protected $fillable = ['nama_mapel','created_at', 'updated_at'];

    public function dataAjar()
    {
        return $this->hasMany(Ajar::class);
    }
}
