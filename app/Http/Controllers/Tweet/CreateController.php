<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(CreateRequest $request): RedirectResponse
    {
        $tweet = new Tweet();
        $tweet->content = $request->tweet();
        $tweet->save();

        return redirect()->route('tweet.index');
    }
}
