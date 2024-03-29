<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * ACCESSOR
    */
    public function getAvatarAttribute()
    {
        $name = $this->name;
        return "https://ui-avatars.com/api/?size=64&rounded=true&name={$name}";
    }

    /**
     * RELATIONSHIP METHODS
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function votesQuestions()
    {
        return $this->morphedByMany(Question::class, 'vote')->withTimestamps();
    }
    public function votesAnswers()
    {
        return $this->morphedByMany(Answer::class, 'vote')->withTimestamps();
    }
}
