<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Service\TweetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param TweetService $tweetService
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(Request $request, TweetService $tweetService): RedirectResponse
    {
        $tweetId = (int)$request->route('tweetId');
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }
        $tweetService->deleteTweet($tweetId);

        return redirect()->route('tweet.index')->with('feedback.success', 'つぶやきを削除しました');
    }
}
