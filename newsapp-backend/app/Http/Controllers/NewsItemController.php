<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsItem;
use App\Mail\NewsItemPublished;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Events\NewsItemCreated;



class NewsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * Uses caching to improve performance by storing the result of the database call.
     */
    public function index()
    {
        $newsItems = Cache::remember('news_items', 3600, function () {
            \Log::info('Fetching news items from DB and caching them.');
            return NewsItem::all();
        });
        \Log::info('Retrieved news items from cache.');

        return response()->json($newsItems);
    }

    /**
     * Store a newly created resource in storage.
     * Validates input, creates the news item, clears the cache, and sends an email notification.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
        ]);

        $newsItem = NewsItem::create($validatedData);
        Cache::forget('news_items'); // Clears the cache to ensure the index method fetches fresh data

        \Log::info('About to send email...');
        Mail::to('from@example.com')->send(new NewsItemPublished($newsItem)); // Adjust recipient as needed
        \Log::info('Email should have been sent...');

        broadcast(new NewsItemCreated($newsItem))->toOthers(); //websocket related
        return response()->json($newsItem, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return response()->json($newsItem);
    }

    /**
     * Update the specified resource in storage.
     * Validates input and updates the specified news item.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'summary' => 'nullable',
            'content' => 'required',
        ]);

        $newsItem = NewsItem::findOrFail($id);
        $newsItem->update($validatedData);
        Cache::forget('news_items'); // Clears the cache to ensure the index method fetches fresh data

        return response()->json($newsItem);
    }

    /**
     * Remove the specified resource from storage.
     * Deletes the specified news item and clears the cache.
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        $newsItem->delete();
        Cache::forget('news_items'); // Clears the cache to ensure the index method fetches fresh data

        return response()->json(null, 204); // No content to return
    }
}
