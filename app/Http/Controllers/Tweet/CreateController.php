<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Service\TweetService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CreateRequest $request
     * @param TweetService $tweetService
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(CreateRequest $request, TweetService $tweetService): RedirectResponse
    {
        $tweetService->saveTweet(
            $request->userId(),
            $request->tweet(),
            $request->images()
        );

        return redirect()->route('tweet.index');
    }
}
