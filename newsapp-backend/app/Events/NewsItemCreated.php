<?php

namespace App\Events;

use App\Models\NewsItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewsItemCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newsItem;

    public function __construct(NewsItem $newsItem)
    {
        $this->newsItem = $newsItem;
    }

    public function broadcastOn()
    {
        return new Channel('news');
    }
}
