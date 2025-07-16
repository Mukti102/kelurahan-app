<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $table = "letters";
    protected $guarded = ['id'];


    protected $casts = [
        'berkas' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function letterType()
    {
        return $this->morphTo('letterable');
    }

    public function scopeDynamicPriority($query)
    {
        return $query->orderBy('priority', 'desc')
            ->orderBy('created_at', 'asc');
    }

    // Scope untuk FIFO (First In First Out)
    public function scopeFirstInFirstOut($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}
