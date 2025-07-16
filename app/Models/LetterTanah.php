<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterTanah extends Model
{
    protected $table = "letter_tanahs";
    protected $guarded = ['id'];

    public function letter()
    {
        return $this->morphOne(Letter::class, 'letterable');
    }
}
