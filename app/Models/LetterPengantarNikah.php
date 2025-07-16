<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterPengantarNikah extends Model
{
    protected $table = "letter_pengantar_nikahs";
    protected $guarded = ['id'];

    public function letter()
    {
        return $this->morphOne(Letter::class, 'letterable');
    }
}
