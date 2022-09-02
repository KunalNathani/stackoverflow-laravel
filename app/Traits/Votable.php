<?php

namespace App\Traits;

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
}
