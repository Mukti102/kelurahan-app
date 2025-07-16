<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterSKCK extends Model
{
    use HasFactory;
    protected $table = "letter_s_k_c_k_s";
    protected $guarded = ['id'];

    public function letter()
    {
        return $this->morphOne(Letter::class, 'letterable');
    }
}
