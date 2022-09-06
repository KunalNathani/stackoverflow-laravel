<?php

namespace App\Models;

use App\Traits\Votable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory, Votable;

    protected $guarded = ['id'];

    public function markAsBest(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

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

    public function getIsFavoriteAttribute()
    {
        return $this->favorites()->where(['user_id'=> auth()->id()])->count() > 0;
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
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

    public function favorites()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
