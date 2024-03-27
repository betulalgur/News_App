<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyNewsSummary;
use App\Models\NewsItem;

class SendDailyNewsSummary extends Command
{
    protected $signature = 'send:daily-news-summary';
    protected $description = 'Sends a daily summary of all news items added that day.';

    public function handle()
    {
        $today = now()->format('Y-m-d');
        $newsItems = NewsItem::whereDate('created_at', $today)->get();

        if ($newsItems->isEmpty()) {
            $this->info('No news items to send for today.');
            return;
        }

        $summary = $newsItems->reduce(function ($carry, $item) {
            return $carry .= "\nTitle: " . $item->title . "\nSummary: " . $item->summary . "\n\n";
        }, '');

        Mail::to('from@example.com')->send(new DailyNewsSummary($newsItems));

        $this->info('Daily news summary email has been sent.');
    }
}
