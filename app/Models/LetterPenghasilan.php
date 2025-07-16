<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterPenghasilan extends Model
{
    use HasFactory;
    protected $table = "letter_penghasilans";
    protected $guarded = ['id'];

    public function letter()
    {
        return $this->morphOne(Letter::class, 'letterable');
    }
}
