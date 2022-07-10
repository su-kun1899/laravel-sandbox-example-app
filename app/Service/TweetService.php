<?php

namespace App\Service;

use App\Models\Tweet;
use Illuminate\Support\Collection;

class TweetService
{
    /**
     * @return Collection<Tweet>
     */
    public function getTweets(): Collection
    {
        return Tweet::orderByDesc('created_at')->get();
    }

}
