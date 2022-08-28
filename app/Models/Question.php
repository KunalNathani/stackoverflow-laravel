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
     * ACCESSOR
     */
    public function getUrlAttribute()
    {
        return "/questions/$this->slug";
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStylesForAnswerAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id)
                return 'has-best-answer';
            else
                return 'answered';
        }
        return 'unanswered';
    }

    public function getAvatarAttribute()
    {
        $name = $this->owner->name;
        return "https://ui-avatars.com/api/?size=64&rounded=true&name={$name}";
    }

    /**
     * RELATIONSHIP METHODS
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
