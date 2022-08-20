<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * RELATIONSHIP METHODS
     */
    public function owner()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
