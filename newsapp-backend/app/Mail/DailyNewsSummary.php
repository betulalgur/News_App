<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsItem;

class DailyNewsSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $newsItems;

    public function __construct($newsItems)
    {
        $this->newsItems = $newsItems;
    }

    public function build()
    {
        return $this->subject('Daily News Summary')->view('emails.news.daily_news_summary');
    }
}
