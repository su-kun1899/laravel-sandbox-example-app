<?php

namespace App\Service;

use App\Models\Tweet;
use Carbon\Carbon;
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

    /**
     * 自分の Tweet かどうかをチェックする
     *
     * @param int $userId
     * @param int $tweetId
     * @return bool
     */
    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }

        return $tweet->user_id === $userId;
    }

    /**
     * 前日のつぶやき数を取得する
     *
     * @return int
     */
    public function countYesterdaysTweets(): int
    {
        return Tweet::whereDate(
            'created_at',
            '>=',
            Carbon::yesterday()->toDateTimeString()
        )->whereDate(
            'created_at',
            '<',
            Carbon::today()->toDateTimeString()
        )->count();
    }
}
