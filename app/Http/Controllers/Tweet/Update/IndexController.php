<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $tweetId = $request->route('tweetId');
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();

        return view('tweet.update')->with('tweet', $tweet);
    }
}
