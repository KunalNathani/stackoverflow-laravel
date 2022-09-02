<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::created(function($answer) {
            $answer->question->increment('answers_count');
        });
    }
    /**
    * ACCESSOR
    */
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function isBest(Question $question)
    {
        return $question->best_answer_id === $this->id;
    }

    /**
    * RELATIONSHIP METHODS
    */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'vote')->withTimestamps();
    }
}
