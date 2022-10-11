<?php

namespace App\Service;

use App\ImageUpload\ImageManagerInterface;
use App\Models\Image;
use App\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class TweetService
{
    public function __construct(private ImageManagerInterface $imageManager)
    {
    }

    /**
     * @return Collection<Tweet>
     */
    public function getTweets(): Collection
    {
        return Tweet::with('images')->orderByDesc('created_at')->get();
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

    /**
     * @param int $userId
     * @param string $content
     * @param array $images
     * @throws Throwable
     */
    public function saveTweet(int $userId, string $content, array $images): void
    {
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet();
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach ($images as $image) {
                $this->imageManager->save($image);
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();
                $tweet->images()->attach($imageModel->id);
            }
        });
    }

    /**
     * @param int $tweetId
     * @throws Throwable
     */
    public function deleteTweet(int $tweetId): void
    {
        DB::transaction(function () use ($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            $tweet->images()->each(function ($image) use ($tweet) {
                $this->imageManager->delete($image->name);
                $tweet->images()->detach($image->id);
                $image->delete();
            });

            $tweet->delete();
        });
    }
}
