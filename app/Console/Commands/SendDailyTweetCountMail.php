<?php

namespace App\Console\Commands;

use App\Mail\DailyTweetCount;
use App\Models\User;
use App\Service\TweetService;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailer;

class SendDailyTweetCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-tweet-count-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日のつぶやき数を集計してつぶやきを促すメールを送ります。';

    private TweetService $tweetService;
    private Mailer $mailer;

    /**
     * Create a new command instance
     *
     * @param TweetService $tweetService
     * @param Mailer $mailer
     */
    public function __construct(TweetService $tweetService, Mailer $mailer)
    {
        parent::__construct();
        $this->tweetService = $tweetService;
        $this->mailer = $mailer;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $tweetCount = $this->tweetService->countYesterdaysTweets();

        $users = User::get();

        foreach ($users as $user) {
            $this->mailer->to($user->email)->send(new DailyTweetCount($user, $tweetCount));
        }

        return 0;
    }
}
