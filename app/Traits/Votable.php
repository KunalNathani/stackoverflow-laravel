<?php

namespace App\Traits;

use App\Models\User;

trait Votable
{
    public function vote(int $vote)
    {
        $this->votes()->attach(auth()->id(), ['vote'=>$vote]);
        if($vote<0) {
            $this->decrement('votes_count');
        } else {
            $this->increment('votes_count');
        }
    }

    public function hasMarkedUpVote(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->where('vote', 1)->exists();
    }

    public function hasMarkedDownVote(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->where('vote', -1)->exists();
    }

    public function hasVoted(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->exists();
    }

    public function updateVote(int $vote)
    {
        $this->votes()->updateExistingPivot(auth()->id(), ['vote'=> $vote]);
        if($vote > 0) {
            $this->increment('votes_count');
            $this->increment('votes_count');
        } else {
            $this->decrement('votes_count');
            $this->decrement('votes_count');
        }
    }
}
