<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'activation_code',
        'role',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'activation_code',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'diff_created',
        'diff_updated'
    ];
    
    public function getDiffCreatedAttribute()
    {
        return now()->parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getDiffUpdatedAttribute()
    {
        return now()->parse($this->attributes['updated_at'])->diffForHumans();
    }

    public function dataguru()
    {
        return $this->hasMany(Teacher::class);
    }

    public function datasiswa()
    {
        return $this->hasMany(Student::class);
    }
}
