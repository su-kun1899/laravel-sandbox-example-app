<?php

namespace App\View\Components\Tweet;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Options extends Component
{
    private int $tweetId;
    private int $userId;

    /**
     * Create a new component instance.
     *
     * @param int $tweetId
     * @param int $userId
     */
    public function __construct(int $tweetId, int $userId)
    {
        $this->tweetId = $tweetId;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.tweet.options')
            ->with('tweetId', $this->tweetId)
            ->with('myTweet', Auth::id() === $this->userId);
    }
}
