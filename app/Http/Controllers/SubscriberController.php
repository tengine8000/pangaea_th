<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subscriber;
use App\Models\Subscription;

class SubscriberController extends Controller
{
    public function subscribe(Request $request, $topic)
    {
        $validatedData = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $topic = Topic::firstOrCreate(['topic' => strtolower($topic)]);
        $subscriber = Subscriber::firstOrCreate(['url' => strtolower($validatedData['url'])]);

        if(!Subscription::where('topic_id', $topic->id)
        ->where('subscriber_id', $subscriber->id)->exists()){
            Subscription::create([
                'topic_id' => $topic->id,
                'subscriber_id' => $subscriber->id,
            ])->save();
        }

        return response()->json([
            'url' => $validatedData['url'],
            'topic' => $topic->topic,
        ],200,[],JSON_UNESCAPED_SLASHES);
    }
}
