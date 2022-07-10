<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Service\TweetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param TweetService $tweetService
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, TweetService $tweetService): View|Factory|Application
    {
        $tweets = $tweetService->getTweets();

        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}
