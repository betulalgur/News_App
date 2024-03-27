<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsItem;


class NewsItemPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $newsItem;

    public function __construct(NewsItem $newsItem)
    {
        $this->newsItem = $newsItem;
    }

    public function build()
    {
        return $this->subject('New Item Published!')
        ->view('emails.news.published')
            ->with(['newsItem' => $this->newsItem]);
    }
}
