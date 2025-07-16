<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    /** @use HasFactory<\Database\Factories\PendudukFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function keluarga()
    {
        return $this->hasOne(Keluarga::class);
    }

    public function perkawinan()
    {
        return $this->hasOne(Perkawinan::class);
    }

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class);
    }

    public function kesehatan()
    {
        return $this->hasOne(Kesehatan::class);
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class);
    }
}
