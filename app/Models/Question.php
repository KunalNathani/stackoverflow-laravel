<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * MUTATORS
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    /**
     * RELATIONSHIP METHODS
     */
    public function owner()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
